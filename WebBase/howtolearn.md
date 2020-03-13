# PHP Yii2 后台框架搭建与学习


本文为team28 后台搭建流程，php学习，yii2学习专用文档


# Yii搭建

## yii安装
参考学习地址：https://www.yiichina.com/doc/guide/2.0/start-installation
按照步骤即可安装成功。
###本项目开发环境为 Windows ，需要下载并运行 Composer-Setup.exe。
####安装完毕后，执行composer create-project --prefer-dist yiisoft/yii2-app-basic WebBase 即可。
####安装前需要确认php开启了应该开启的扩展。
###为了不出错，可开启全部有需要的扩展。
extension=bz2
extension=curl
extension=fileinfo
extension=gd2
extension=gettext
extension=gmp
extension=intl
extension=imap
extension=ldap
extension=mbstring
extension=mysqli
extension=openssl
extension=soap
extension=sockets
extension=sqlite3
extension=xmlrpc
extension=xsl