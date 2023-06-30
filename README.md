# middle-office-mc
古珀对外服务-消息中心（message center）


#### 使用
-	导入本包
-	在项目根目录的config目录下，新建middleoffice.php文件，内容如下：
```
	return [
		'id' => env('AUTH_CENTER_APP_ID'),
		'app_id' => env('AUTH_CENTER_APP_KEy'),
		'app_secret' => env('AUTH_CENTER_APP_SECRET'),
	];
```
-	参数需要去用户中心获取
		-	AUTH_CENTER_APP_ID（用户中心获取到的应用id）
		-	AUTH_CENTER_APP_KEY（用户中心获取到的app key）
		-	AUTH_CENTER_APP_SECRET（用户中心获取到的app secret）
-	实现MessageCenterClient类，调用方法即可
```php
(new MessageCenterClient())->sendMsg($body, $endpoint, $headerExtra);
```