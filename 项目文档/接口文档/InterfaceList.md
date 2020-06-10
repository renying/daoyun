# 到云接口列表

##  测试线接口地址 $url= 'http://localhost:8080/'
##  正式线接口地址 $url= 'http://47.94.234.206/'

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
	"msg":"true",
	"data":{
        "userid":1,//用户id
        "ukey":"99b183449091667a53cc4c27caaf8b6a"//token
    }
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 1002 | 用户名或密码错误     |

##  二、用户注册接口

###  接口地址：

api/user-register

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
	"msg":"true",
	"data":"1"//返回注册的用户userid
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |

##  三、用户信息修改接口

###  接口地址：

api/user-updateinfo

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 用户id，非int，需要上传MD5值，即标准MD5(userid)              |
| ukey      | string   | Y        | 用户token|
| NickName  | string   | N        | 昵称                                                         |
| BornDate  | string   | N        | 生日，例：（1995-05-04）                                     |
| Address   | string   | N        | 住址                                                         |
| Phone     | long     | N        | 电话号码                                                     |
| UserCode  | string   | N        | 学号，工号                                                   |
| RealName  | string   | N        | 真名                                                         |
| UserSex   | int      | N        | 性别（1、男，2、女）                                         |
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(u+ p+TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"msg":"true",
	"data":"1"//返回注册的用户userid
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 1002 | 用户信息获取错误     |



## 四、用户信息获取接口

### 接口地址：

api/get-userinfo

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 用户id，非int，需要上传MD5值，即标准MD5(userid)              |
| ukey      | string   | Y        | 用户token|
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(ui+TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

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

##  五、班课信息获取接口

### 接口地址：

api/get-classinfo

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 用户id，非int，需要上传MD5值，即标准MD5(userid)              |
| ukey      | string   | Y        | 用户token|
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"true",//异常说明
	"data":
	{
	"Joined":[{
		"ClassId":1,
		"ClassName":"23650",//课程名称
		"ClassCode":"23650",//课程号
		"ClassDesc":"课程说明",
		"CreateTime":"2020-04-15",//创建时间
		"UserName":"创建人用户名",
		"UserCode":"创建人工号",
		"SchoolInfo":"院系信息",
	}],
	"Created":[{
		"ClassId":1,
		"ClassName":"23650",//课程名称
		"ClassCode":"23650",//课程号
		"ClassDesc":"课程说明",
		"CreateTime":"2020-04-15",//创建时间
		"UserName":"创建人用户名",
		"UserCode":"创建人工号",
		"SchoolInfo":"院系信息",
	}],
    }
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 9999 | 系统错误             |



## 六、班课成员信息获取

### 接口地址：

api/get-classuserlist

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 用户id，非int，需要上传MD5值，即标准MD5(userid)              |
| ukey      | string   | Y        | 用户token|
| classid   | int      | Y        | 课程编号                                                   |
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(ui + classId + TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"true",//异常说明
	"data":{
        "ClassName":"课程名",
        "CheckCount":12,//当前用户签到次数
        "UserCount":110,//成员总数
        "UserList":[
            {
                "UserId":555,//用户编号
                "UserName":"用户名称",
                "UserCode":52645//用户学号
            },
            ...
            {
                "UserId":655,//用户编号
                "UserName":"用户名称",
                "UserCode":72645//用户学号
            }
        ]
    }
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 1002 | 用户id不正确         |
| 1003 | 课程编号不正确       |
| 9999 | 系统错误             |



## 七、消息通知列表获取

### 接口地址：

api/get-usernoticelist

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 用户id，非int，需要上传MD5值，即标准MD5(userid)              |
| ukey      | string   | Y        | 用户token|
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(ui + TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"true",//异常说明
	"data":{
        "NoticeList":[
            {
                "FromName":"工程实践",//用户编号
                "HasNew":False,//是否有新消息
                "NoticeType":1//1、班课通知，2、用户消息
            },
            ...
            {
                "FromName":"王五",//用户编号
                "HasNew":True,//是否有新消息
                "NoticeType":2//1、班课通知，2、用户消息
            }
        ]
    }
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 1002 | 用户id不正确         |
| 9999 | 系统错误             |



## 八、消息详情列表获取

### 接口地址：

api/get-noticeinfolist

###  输入参数：

| 参数名称   | 参数类型 | 是否必填 | 参数说明                                                     |
| ---------- | -------- | -------- | ------------------------------------------------------------ |
| FromUserId | string   | Y        | 发送消息的用户id，非int，需要上传MD5值，即标准MD5(userid)    |
| ukey      | string   | Y        | 用户token|
| ToUserId   | string   | Y        | 接受消息的用户id，非int，需要上传MD5值，即标准MD5(userid)    |
| TimeStamp  | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode  | string   | Y        | 校验码，格式为：标准MD5(ui + TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"true",//异常说明
	"data":{
        "NoticeList":[
            {
                "FromName":"工程实践",//发消息的用户
                "ToName":"王五",//接受消息的用户
                "InfoContent":"由于五一假期，课程顺延至下周末上课",//消息内容
                "ReadType":False,//是否已读
                "InfoDate": "2020-06-09 22:32:47",
                "NoticeType":1//1、班课通知，2、用户消息
            },
            ...
            {
                "FromName":"赵四",//发消息的用户
                "ToName":"王五",//接受消息的用户
                "InfoContent":"你笔记借我看一下",//消息内容
                "ReadType":False,//是否已读
                "InfoDate": "2020-06-09 22:32:47",
                "NoticeType":2//1、班课通知，2、用户消息
            }
        ]
    }
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 9999 | 系统错误             |


## 九、创建班课

### 接口地址：

api/add-classinfo

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 当前用户id，非int，需要上传MD5值，即标准MD5(userid)          |
| ukey      | string   | Y        | 用户token                                                    |
| className | string   | Y        | 课程名称                                                     |
| classDesc | string   | Y        | 课程简介                                                     |
| classCode | string   | Y        | 课程编号                                                     |
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(ui +className +  TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"创建成功",//异常说明
	"data":true
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 9999 | 系统错误             |

## 十、修改密码

### 接口地址：

api/change-pass

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 当前用户id，非int，需要上传MD5值，即标准MD5(userid)          |
| ukey      | string   | Y        | 用户token                                                    |
| oldpass   | string   | Y        | 旧密码                                                       |
| newpass   | string   | Y        | 新密码                                                       |
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(ui +className +  TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"修改成功",//异常说明
	"data":true
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 9999 | 系统错误             |



## 十一、课堂签到接口

### 接口地址：

api/checkin

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 当前用户id，非int，需要上传MD5值，即标准MD5(userid)          |
| ukey      | string   | Y        | 用户token                                                    |
| classId   | int      | Y        | 课程编号                                                     |
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(ui +className +  TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"签到成功",//异常说明
	"data":48,//用户当前积分
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 9999 | 系统错误             |

## 十二、加入班课接口

### 接口地址：

api/choose-class

###  输入参数：

| 参数名称  | 参数类型 | 是否必填 | 参数说明                                                     |
| --------- | -------- | -------- | ------------------------------------------------------------ |
| ui        | string   | Y        | 当前用户id，非int，需要上传MD5值，即标准MD5(userid)          |
| ukey      | string   | Y        | 用户token                                                    |
| classId   | int      | Y        | 课程编号                                                     |
| TimeStamp | string   | Y        | 时间戳，格式为：yyyyMMddHHmmss例如：20200411155201           |
| CheckCode | string   | Y        | 校验码，格式为：标准MD5(ui +className +  TimeStamp + 平台密钥) （加号代表连接符，非数值运算） |

### 返回结果：

```c#
{
	"code":1,
	"message":"加入成功",//异常说明
	"data":true,
}
```

### code说明

| 值   | 说明                 |
| ---- | -------------------- |
| 1    | 成功                 |
| 1001 | 接口没有使用post请求 |
| 9999 | 系统错误             |
