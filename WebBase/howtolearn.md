# PHP Yii2 后台框架搭建与学习


本文为team28 后台搭建流程，php学习，yii2学习专用文档


# Yii搭建

## yii安装
参考学习地址：https://www.yiichina.com/doc/guide/2.0/start-installation
按照步骤即可安装成功。
### 本项目开发环境为 Windows ，需要下载并运行 Composer-Setup.exe。
#### 安装完毕后，执行composer create-project --prefer-dist yiisoft/yii2-app-basic WebBase 即可。
#### 安装前需要确认php开启了应该开启的扩展。
### 为了不出错，可开启全部有需要的扩展。
- extension=bz2
- extension=curl
- extension=fileinfo
- extension=gd2
- extension=gettext
- extension=gmp
- extension=intl
- extension=imap
- extension=ldap
- extension=mbstring
- extension=mysqli
- extension=openssl
- extension=soap
- extension=sockets
- extension=sqlite3
- extension=xmlrpc
- extension=xsl
### 启动方式：php yii serve
### 访问地址：http://localhost:8080/


###  使用Gii自动生成代码
###  参考链接：https://www.yiichina.com/doc/guide/2.0/start-gii
###  本地gii打开地址：http://localhost:8080/gii
###  前期工作
- 需要在 config/db.php 配置mysql链接信息
- 需要开启php中pdo_mysql 的支持
- 其余按照文档操作即可
###  潜在问题
- 自动生成的页面表单是英文，可手动修改表单显示。路径：models/User.php 函数： attributeLabels
- 页面交互会验证cookie，Csrf。不能直接用调接口的方式post请求。为了安全起见，对调用需求，需要另开接口实现业务逻辑。


# yii发布说明



## 1、linux 安装php-fpm、nginx、git软件

## 2、用git将代码下载下来

## 3、环境配置

###  php-fpm配置：

```nginx
默认配置路径：/etc/php-fpm.d/www.conf
需要修改的地方：

listen = /dev/php/php-fpm.sock

listen.owner = root
listen.group = root
listen.mode = 0666
```

### nginx 配置

```nginx
默认配置路径：/etc/nginx/nginx.conf
需要修改的地方：

user root;

listen       80;
server_name  47.94.234.206;
root         /root/WebBase/web;

location / {
	index index.php index.html index.htm;
}
location ~ \.php$ {
	root /root/WebBase/web; 
	fastcgi_pass unix:/dev/php/php-fpm.sock;
	fastcgi_index index.php;
	fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
	include fastcgi_params;
}
```

###  文件夹权限授予

```nginx
虽然listen = 0666 可以自动开启权限，但发现并非如此
要手动赋值比较不会出错
chmod 1777 /dev/php/php-fpm.sock
chmod 1777 /dev/php
chmod 1777 /dev/
```

###  程序启动

```nginx
service php-fpm start //启动
service php-fpm stop  //关闭

service nginx start //启动
serivce nginx stop  //关闭

```

### 访问

http://47.94.234.206/index.php

