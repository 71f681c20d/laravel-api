<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use RdKafka\Consumer;
use RdKafka\Conf;

class KafkaConsumer extends Command
{
    protected $signature = 'app:kafka-consumer';

    protected $description = 'Consume messages from Kafka';

    public function handle()
    {
        $broker = "localhost:9092";
        $topic = "users";

        $pdo = new PDO("pgsql:host=localhost;dbname=my_database", "my_username", "my_password");

        // Create Kafka consumer
        $conf = new Conf();
        $conf->set('group.id', 'my_consumer_group');
        $consumer = new Consumer($conf);
        $consumer->addBrokers($broker);

        // Subscribe to the topic
        $topicConf = new \RdKafka\TopicConf();
        $topicConf->set('auto.offset.reset', 'smallest');
        $topic = $consumer->newTopic($topic, $topicConf);
        $topic->consumeStart(0, RD_KAFKA_OFFSET_END);

        $this->info("Listening for new_user messages...");

        // Consume messages
        while (true) {
            $message = $topic->consume(0, 1000);

            if ($message->err) {
                $this->error("Error: {$message->errstr()}, code: {$message->err}");
                continue;
            }

            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    if ($message->payload === "new_user") {
                        // Process new_user message
                        $user = json_decode($message->payload, true);

                        // Insert user into database
                        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
                        $stmt->execute([$user['name'], $user['email']]);

                        $this->info("New user inserted: {$user['name']} ({$user['email']})");
                    }
                    break;
                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    $this->info("No more messages; will wait for more");
                    break;
                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                    $this->info("Timed out");
                    break;
                default:
                    $this->error("Error: {$message->errstr()}, code: {$message->err}");
                    break;
            }
        }

        // Clean up
        $topic->consumeStop(0);
        $consumer->unsubscribe();
    }
}

