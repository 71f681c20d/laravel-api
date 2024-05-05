<?php declare(strict_types=1);
// Generated by the protocol buffer compiler.  DO NOT EDIT!
// source: src/Tracing/FederatedTracing/reports.proto

namespace Nuwave\Lighthouse\Tracing\FederatedTracing\Proto;

use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>ContextualizedQueryLatencyStats</code>.
 */
class ContextualizedQueryLatencyStats extends \Google\Protobuf\Internal\Message
{
    /** Generated from protobuf field <code>.QueryLatencyStats query_latency_stats = 1 [json_name = "queryLatencyStats"];</code> */
    protected $query_latency_stats;

    /** Generated from protobuf field <code>.StatsContext context = 2 [json_name = "context"];</code> */
    protected $context;

    /**
     * Constructor.
     *
     * @param  array  $data {
     *     Optional. Data for populating the Message object.
     *
     *     @var \Nuwave\Lighthouse\Tracing\FederatedTracing\Proto\QueryLatencyStats $query_latency_stats
     *     @var \Nuwave\Lighthouse\Tracing\FederatedTracing\Proto\StatsContext $context
     * }
     */
    public function __construct($data = null)
    {
        Metadata\Reports::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.QueryLatencyStats query_latency_stats = 1 [json_name = "queryLatencyStats"];</code>.
     *
     * @return \Nuwave\Lighthouse\Tracing\FederatedTracing\Proto\QueryLatencyStats|null
     */
    public function getQueryLatencyStats()
    {
        return $this->query_latency_stats;
    }

    public function hasQueryLatencyStats()
    {
        return isset($this->query_latency_stats);
    }

    public function clearQueryLatencyStats()
    {
        unset($this->query_latency_stats);
    }

    /**
     * Generated from protobuf field <code>.QueryLatencyStats query_latency_stats = 1 [json_name = "queryLatencyStats"];</code>.
     *
     * @param  \Nuwave\Lighthouse\Tracing\FederatedTracing\Proto\QueryLatencyStats  $var
     *
     * @return $this
     */
    public function setQueryLatencyStats($var)
    {
        GPBUtil::checkMessage($var, QueryLatencyStats::class);
        $this->query_latency_stats = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.StatsContext context = 2 [json_name = "context"];</code>.
     *
     * @return \Nuwave\Lighthouse\Tracing\FederatedTracing\Proto\StatsContext|null
     */
    public function getContext()
    {
        return $this->context;
    }

    public function hasContext()
    {
        return isset($this->context);
    }

    public function clearContext()
    {
        unset($this->context);
    }

    /**
     * Generated from protobuf field <code>.StatsContext context = 2 [json_name = "context"];</code>.
     *
     * @param  \Nuwave\Lighthouse\Tracing\FederatedTracing\Proto\StatsContext  $var
     *
     * @return $this
     */
    public function setContext($var)
    {
        GPBUtil::checkMessage($var, StatsContext::class);
        $this->context = $var;

        return $this;
    }
}