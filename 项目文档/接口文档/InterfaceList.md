# 到云接口列表

##  测试线接口地址 $url= 'http://localhost:8080/'
##  正式线接口地址 $url= 'http://111.229.250.170/'

##  一、登陆校验接口

###  接口地址：

api/user-login

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| u         | string   | Y        | 用户名                                                       |
| p         | string   | Y        | 密码                                                         |
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(u+ p+TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"true",
	"data":"1"//返回登陆的用户userid
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 1002 | 用户名或密码错误     |

## 二、用户信息获取接口

### 接口地址：

api/get-userinfo

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 用户id，非int，需要上传MD5值，即标准MD5(userid)              |
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(ui+ p+TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"true",//异常说明
	"data":{
        "UserName":"testadd",
        "NickName":"d",
        "BornDate":"2001-10",
        "UserSex":1,//用户性别
        "UserType":2,//用户类型
        "CountryId":3,
        "Address":"",
        "SchoolId":3,
        "UserCode":"",
        "RealName":"",
        "Phone":""
    }
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 1002 | 用户ID错误           |
