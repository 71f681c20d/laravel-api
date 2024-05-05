<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Console\Commands\KafkaConsumer;
use RdKafka\Message;

class KafkaConsumerTest extends TestCase
{
    /**
     * Test Kafka consumer functionality.
     *
     * @return void
     */
    public function testKafkaConsumer()
    {
        // Mock PDO instance
        $pdoMock = $this->getMockBuilder(\PDO::class)
                        ->disableOriginalConstructor()
                        ->getMock();
        $pdoMock->expects($this->once())
                ->method('prepare')
                ->willReturnSelf();
        $pdoMock->expects($this->once())
                ->method('execute')
                ->willReturn(true);

        // Mock RdKafka\Message instance
        $messageMock = $this->getMockBuilder(Message::class)
                            ->disableOriginalConstructor()
                            ->getMock();
        $messageMock->err = RD_KAFKA_RESP_ERR_NO_ERROR;
        $messageMock->payload = json_encode(['name' => 'John Doe', 'email' => 'john@example.com']);

        // Mock RdKafka\Consumer instance
        $consumerMock = $this->getMockBuilder(\RdKafka\Consumer::class)
                             ->disableOriginalConstructor()
                             ->getMock();
        $consumerMock->method('consume')
                     ->willReturn($messageMock);

        // Create KafkaConsumer instance
        $kafkaConsumer = new KafkaConsumer();
        $kafkaConsumer->setPdo($pdoMock);
        $kafkaConsumer->setConsumer($consumerMock);

        // Run the Kafka consumer
        $this->expectOutputRegex('/New user inserted: John Doe \(john@example\.com\)/');
        $kafkaConsumer->handle();
    }
}
