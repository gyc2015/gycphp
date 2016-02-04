# 一个PHP的MVC框架

捣鼓了一段时间的web编程, 想为自己建一个博客系统, 下了wordpress, 这货实在太大.
于是想自己搞一套, 这里的源码主要参考了zentaoPHP框架.

## 约定

* app是服务器发布在互联网上的一个应用, 表现为请求链接中的主机和路径部分.
* module是app的模块, 一个app可以有多个module构成, 一个module还可以有sub-module.
* 一个module必须在app根目录下存在一个以module name命名的子目录. 在该子目录下必须有一个control.php文件,
	其中实现了以module name命名的类并继承了control基类, 该类的对象就是module的control对象, 实现了程序的控制逻辑.
* 一个module的model对象负责实现数据库等与数据相关的访问, 其实现需要在module的根目录下有一个继承了model的类,
	其命名规则为module name后接一个后缀'M',例如一个module 'header'其model对象为'headerM'. 对应model.php文件.
* 一个module的view对象负责实现网页的各种模板, 其实现需要在module的根目录下有一个继承了view的类, 
	其命名规则为module name后接一个后缀'V',例如一个module 'header'其model对象为'headerV'. 对应view.php文件.
	有时可以不实现这个子类, 默认MVC框架会自动创建一个view类型的对象作为module的view对象.
* 一个module可以没有model对象, 但一定有control和view对象. 
* 关于view, 在module的根目录下还有一个子目录view, 在该子目录中为view的各种显示模板, 命名规则为*func*.html.php.
	其中*func*为模板名称.
