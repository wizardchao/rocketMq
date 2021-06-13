<?php
namespace wizardchao\logger\driver\flume;

class FlumeLogConstants {

	// 请求ip
	public static $ClientIp = "ip";
	// 服务实例
	public static $InstanceId = "instanceId";
	// 请求唯一ID
	public static $RequestId = "requestId";
	// 请求的地址
	public static $RequestURI = "requestUri";
	// 日志类型
	public static $LogType = "logType";
	// 索引
	public static $IndexName = "indexName";
	// 索引名格式化
	public static $IndexNameFormat = "flumelog-%s-%s";
	// 默认appName
	public static $DefaultAppName = "provider-yuncut";
	// 默认logType
	public static $DefaultLogType = "Log";
	// 请求时间
	public static $RequestTime = "RequestTime";
	// 项目名称
	public static $AppName = "appName";
	// 链路追踪id
	public static $TraceId = "traceId";
	// level
	public static $Level = "level";
}
