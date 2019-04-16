<h1 align="center"> weather </h1>

<p align="center"> 基于<a href="https://lbs.amap.com/dev/id/newuser">高德开放平台</a>的PHP天气信息组件.</p>


## 安装

```shell
$ composer require hanweizhe/weather -vvv
```

## 配置

在使用本扩展之前，你需要去 [高德开放平台](https://lbs.amap.com/dev/id/newuser) 注册账号，然后创建应用，获取应用的 API Key。

## 使用
```php
use Hanweizhe\Weather\Weather;
$key = '申请的key';
$weather = new Weather($key);
```
## 获取实时天气
```php
$response = $weather->getWeather('深圳');
```
示例:
```json
{
    "status": "1",
    "count": "1",
    "info": "OK",
    "infocode": "10000",
    "lives": [
        {
            "province": "广东",
            "city": "深圳市",
            "adcode": "440300",
            "weather": "小雨",
            "temperature": "20",
            "winddirection": "南",
            "windpower": "≤3",
            "humidity": "98",
            "reporttime": "2019-04-16 13:43:44"
        }
    ]
}
```
## 获取近期天气情报
```php
$response = $weather->getWeather('深圳','all');
```
示例:
```json
{
    "status": "1",
    "count": "1",
    "info": "OK",
    "infocode": "10000",
    "forecasts": [
        {
            "city": "深圳市",
            "adcode": "440300",
            "province": "广东",
            "reporttime": "2019-04-16 14:13:45",
            "casts": [
                {
                    "date": "2019-04-16",
                    "week": "2",
                    "dayweather": "暴雨",
                    "nightweather": "阵雨",
                    "daytemp": "23",
                    "nighttemp": "19",
                    "daywind": "无风向",
                    "nightwind": "无风向",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                },
                {
                    "date": "2019-04-17",
                    "week": "3",
                    "dayweather": "阵雨",
                    "nightweather": "阵雨",
                    "daytemp": "26",
                    "nighttemp": "21",
                    "daywind": "无风向",
                    "nightwind": "无风向",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                },
                {
                    "date": "2019-04-18",
                    "week": "4",
                    "dayweather": "阵雨",
                    "nightweather": "阵雨",
                    "daytemp": "26",
                    "nighttemp": "22",
                    "daywind": "无风向",
                    "nightwind": "无风向",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                },
                {
                    "date": "2019-04-19",
                    "week": "5",
                    "dayweather": "阵雨",
                    "nightweather": "阵雨",
                    "daytemp": "27",
                    "nighttemp": "23",
                    "daywind": "无风向",
                    "nightwind": "无风向",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                }
            ]
        }
    ]
}
```
## 获取XML格式返回值
第三个参数为返回值类型，可选 `json` 与 `xml`，默认 `json`：
```php
$response = $weather->getWeather('深圳', 'all', 'xml');
```
示例:
```xml

<?xml version="1.0" encoding="UTF-8"?>
<response><status>1</status><count>1</count><info>OK</info><infocode>10000</infocode><forecasts type="list"><forecast><city>深圳市</city><adcode>440300</adcode><province>广东</province><reporttime>2019-04-16 14:13:45</reporttime><casts type="list"><cast><date>2019-04-16</date><week>2</week><dayweather>暴雨</dayweather><nightweather>阵雨</nightweather><daytemp>23</daytemp><nighttemp>19</nighttemp><daywind>无风向</daywind><nightwind>无风向</nightwind><daypower>≤3</daypower><nightpower>≤3</nightpower></cast><cast><date>2019-04-17</date><week>3</week><dayweather>阵雨</dayweather><nightweather>阵雨</nightweather><daytemp>26</daytemp><nighttemp>21</nighttemp><daywind>无风向</daywind><nightwind>无风向</nightwind><daypower>≤3</daypower><nightpower>≤3</nightpower></cast><cast><date>2019-04-18</date><week>4</week><dayweather>阵雨</dayweather><nightweather>阵雨</nightweather><daytemp>26</daytemp><nighttemp>22</nighttemp><daywind>无风向</daywind><nightwind>无风向</nightwind><daypower>≤3</daypower><nightpower>≤3</nightpower></cast><cast><date>2019-04-19</date><week>5</week><dayweather>阵雨</dayweather><nightweather>阵雨</nightweather><daytemp>27</daytemp><nighttemp>23</nighttemp><daywind>无风向</daywind><nightwind>无风向</nightwind><daypower>≤3</daypower><nightpower>≤3</nightpower></cast></casts></forecast></forecasts></response>
```
参考说明
```php
array|string getWeather(string $city, string $type = 'base', string $format = 'json')
```
* $city - 城市名，比如：“深圳”；
* $type - 返回内容类型：base: 返回实况天气 / all: 返回预报天气；
* $format - 输出的数据格式，默认为 json 格式，当 output 设置为 “xml” 时，输出的为 XML 格式的数据。
## 在Laravel中使用
在 Laravel 中使用也是同样的安装方式，配置写在 config/services.php 中：
```php
    .
    .
    .
     'weather' => [
        'key' => env('WEATHER_API_KEY'),
    ],
```
然后在 `.env` 中配置 `WEATHER_API_KEY` ：
```
WEATHER_API_KEY=xxxxxxxxxxxxxxxxxxxxx
```
可以用两种方式来获取 Hanweizhe\Weather\Weather 实例：

方法参数注入
```php
    .
    .
    .
    public function edit(Weather $weather) 
    {
        $response = $weather->getWeather('深圳');
    }
    .
    .
    .
```
服务名访问

 ```php
    .
    .
    .
    public function edit() 
    {
        $response = app('weather')->getWeather('深圳');
    }
    .
    .
    .
```
参考
* [高德开放平台天气接口](https://lbs.amap.com/api/webservice/guide/api/weatherinfo/)
## License

MIT