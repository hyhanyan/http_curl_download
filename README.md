# http_curl_download


### 说明：
    在编译任何开源代码前可以先看看README， INSTALL等文件，会提供如何编译的信息。
		在此教程中通过阅读README和GIT-INFO文件可以得到很多编译安装信息。在GIT-INFO中很明显地说了执
    行：./buildconf产生configure配置文件。所有不要在这里因为找不到configure文件而懵逼。
### 步骤：
    1.下载libcurl源码：
          git clone https://github.com/curl/curl.git
    2.进入curl工程目录执行./buildconf产生configure配置文件：
    3.执行产生的configure脚本：
         ./configure --enable-debug   在这里我只加了这个参数，为了后续的调试，
         如果还要其他参数，可以./configure --help查看其他可选参数。
         注：我是默认安装openssl的，所已没有出现找不到openssl库的问题。如果遇到了就装一个，选择默认安装省事，自己指定安装目录比较麻烦，还
         要给configure多加个参数。具体查看工程目录下的README。
    4.make
    5.make install        默认库文件安装在/usr/local/lib 头文件安装在/usr/local/include  --->安装要root权限
    6.到/usr/local/lib/即可查看到安装好的库文件
    7.见上面写的代码
    8.curl-config工具简介：
        在安装完libcurl库后会同时安装了curl-config工具，这个工具专门用来查看已安装libcurl的一些信息。有很多参数：
          curl-config --libs            查看我们的代码链接libcurl时需要哪些参数，这个选项我们用的比较多
          curl-config --version    查看libcurl版本
          还有更多参数，不一一列举了，curl-config --help查看更多参数。
    9.编译链接我们的测试代码：
        g++ -o cul_download cul_download.cpp -lcurl  注意：必须要有-lcurl
        ./cul_download http://dz.80txt.com/61064/武极神王.zip hy_h.zip
    
###  总结：
        通过源码编译安装程序，看README很重要，而不是盲目的按那老套路编译安装，很多时候按老套路是行不通的，
        其次，在我们遇到问题了可以直接把错误提示粘到Chrome浏览器搜索栏搜索，一般在英文论坛都有很好的解决方法，很
        多问题都可以在http://stackoverflow.com/这个论坛找到，这个论坛确实不错。
