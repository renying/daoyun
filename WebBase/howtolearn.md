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


