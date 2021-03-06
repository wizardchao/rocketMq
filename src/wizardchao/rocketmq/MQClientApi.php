<?php
namespace wizardchao\rocketmq;

use wizardchao\rocketmq\core\ResponseFuture;
use wizardchao\rocketmq\entity\MessageQueue;
use wizardchao\rocketmq\entity\TopicRouteData;
use wizardchao\rocketmq\exception\RocketMQClientException;
use wizardchao\rocketmq\remoting\AbstractRemotingClient;
use wizardchao\rocketmq\remoting\body\LockBatchRequestBody;
use wizardchao\rocketmq\remoting\body\UnlockBatchRequestBody;
use wizardchao\rocketmq\remoting\callback\InvokeCallback;
use wizardchao\rocketmq\remoting\header\broker\GetConsumerListByGroupRequestHeader;
use wizardchao\rocketmq\remoting\header\broker\GetMaxOffsetRequestHeader;
use wizardchao\rocketmq\remoting\header\broker\QueryConsumerOffsetRequestHeader;
use wizardchao\rocketmq\remoting\header\namesrv\GetRouteInfoRequestHeader;
use wizardchao\rocketmq\remoting\RemotingAsyncClient;
use wizardchao\rocketmq\remoting\RemotingCommand;
use wizardchao\rocketmq\remoting\RemotingSyncClient;
use wizardchao\rocketmq\remoting\RequestCode;
use wizardchao\rocketmq\remoting\ResponseCode;
use wizardchao\rocketmq\util\MQClientUtil;

class MQClientApi {

	/**
	 * 获取主题的路由信息
	 * @param AbstractRemotingClient $client
	 * @param $topic
	 * @return TopicRouteData
	 * @throws exception\RocketMQClientException
	 */
	public static function getRouteInfoFromNamrsrv(RemotingSyncClient $client, $topic) {
		$getRouteInfoRequestHeader = new GetRouteInfoRequestHeader();
		$getRouteInfoRequestHeader->setTopic($topic);
		$requestCommand = RemotingCommand::createRequestCommand(RequestCode::$GET_ROUTEINFO_BY_TOPIC, $getRouteInfoRequestHeader);
		$remotingCommand = $client->send($requestCommand);
		$body = $remotingCommand->getBody();
		$bodyArray = MQClientUtil::formatBodyJson($body);
		return new TopicRouteData($bodyArray);
	}

	/**
	 * @param AbstractRemotingClient $client
	 * @param $consumerGroup
	 * @return array|null
	 */
	public static function getConsumerIdListByGroup(RemotingSyncClient $client, $consumerGroup) {
		$requestHeader = new GetConsumerListByGroupRequestHeader($consumerGroup);
		$request = RemotingCommand::createRequestCommand(RequestCode::$GET_CONSUMER_LIST_BY_GROUP, $requestHeader);
		$response = $client->send($request);
		switch ($response->getCode()) {
		case ResponseCode::$SUCCESS:{
				if ($response->getBody() != null) {
					$rpb = json_decode($response->getBody(), true);
					return $rpb["consumerIdList"] ?? null;
				}
			}
		default:
			break;
		}
		return null;
	}

	public static function getMaxOffset(RemotingSyncClient $client, $topic, $queueId) {
		$requestHeader = new GetMaxOffsetRequestHeader($topic, $queueId);
		$request = RemotingCommand::createRequestCommand(RequestCode::$GET_MAX_OFFSET, $requestHeader);
		$response = $client->send($request);
		switch ($response->getCode()) {
		case ResponseCode::$SUCCESS:{
				if (!empty($response->getExtFields())) {
					$extFields = $response->getExtFields();
					return $extFields["offset"] ?? -1;
				}
			}
		default:
			break;
		}
		return -1;
	}

	/**
	 * 查询消费者消费进度
	 * @param RemotingSyncClient $client
	 * @param QueryConsumerOffsetRequestHeader $requestHeader
	 * @return int|mixed
	 * @throws exception\RocketMQClientException
	 */
	public static function queryConsumerOffset(RemotingSyncClient $client, QueryConsumerOffsetRequestHeader $requestHeader) {
		$request = RemotingCommand::createRequestCommand(RequestCode::$QUERY_CONSUMER_OFFSET, $requestHeader);
		$response = $client->send($request);
		switch ($response->getCode()) {
		case ResponseCode::$SUCCESS:{
				if (!empty($response->getExtFields())) {
					$extFields = $response->getExtFields();
					return $extFields["offset"] ?? -1;
				}
			}
		default:
			break;
		}
		return -1;
	}

	/**
	 * @param RemotingAsyncClient $remotingAsyncClient
	 * @param RemotingCommand $remotingCommand
	 * @param InvokeCallback|null $invokeCallback
	 * @return null
	 * @throws exception\RocketMQClientException
	 */
	public static function invokeAsync(RemotingAsyncClient $remotingAsyncClient, RemotingCommand $remotingCommand, InvokeCallback $invokeCallback = null) {
		$responseFuture = null;
		if (!is_null($invokeCallback)) {
			$responseFuture = new ResponseFuture($remotingCommand->getOpaque(), $invokeCallback);
		}
		return $remotingAsyncClient->send($remotingCommand, $responseFuture);
	}

	/**
	 * @param RemotingSyncClient $client
	 * @param RemotingCommand $remotingCommand
	 * @param LockBatchRequestBody $body
	 * @return MessageQueue[]
	 * @throws RocketMQClientException
	 */
	public static function lockBatchMQ(RemotingSyncClient $client, LockBatchRequestBody $body) {
		$request = RemotingCommand::createRequestCommand(RequestCode::$LOCK_BATCH_MQ, null);
		$request->setBody(json_encode($body));
		$response = $client->send($request);
		switch ($response->getCode()) {
		case ResponseCode::$SUCCESS:{
				$responseBody = json_decode($response->getBody(), true);
				$messageQueues = [];
				if (isset($responseBody['lockOKMQSet'])) {
					foreach ($responseBody['lockOKMQSet'] as $set) {
						$messageQueues[] = new MessageQueue($set['topic'], $set['brokerName'], $set['queueId']);
					}
				}
				return $messageQueues;
			}
		default:
			break;
		}
		throw new RocketMQClientException($response->getCode(), $response->getRemark());
	}

	/**
	 * @param RemotingSyncClient $client
	 * @param UnlockBatchRequestBody $body
	 * @throws RocketMQClientException
	 */
	public static function unlockBatchMQ(RemotingSyncClient $client, UnlockBatchRequestBody $body) {
		$request = RemotingCommand::createRequestCommand(RequestCode::$UNLOCK_BATCH_MQ, null);
		$request->setBody(json_encode($body));
		$response = $client->send($request);
		switch ($response->getCode()) {
		case ResponseCode::$SUCCESS:{
				return;
			}
		default:
			break;
		}
		throw new RocketMQClientException($response->getCode(), $response->getRemark());
	}
}