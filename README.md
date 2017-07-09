# Team-Cooperation-
仿teambition的团队协作应用demo

前端使用bootstrap + jQuery、后端使用WAMPServer + Codeigniter 简单构建的单页面应用

团队协作应用主要有三大核心模块：任务管理、文件分享、实时沟通。这里参照teambition，简单实现了任务管理的基本功能

因为目前前端经验不足，bootstrap+jQuery构造的SPA应用复杂度高，很多代码未能实现重用，难以维护，因此写到一半无法往下写了，原计划是完整实现任务管理、文件分享、实时沟通三大系统；计划使用vue.js 进行重构，对前端代码进行解耦、组件化

## 使用：
 1. 安装wampserver
 2. 将www 文件夹拷贝到wamp 目录下
 3. 新建数据库teamwork，并导入teamwork.sql
 4. 输入localhost/index.php/signin 进行登录

## 未解决的问题：
 * 未对用户输入进行处理，存在xss漏洞
 * 用户密码未做哈希保存
 * 使用了手动拼接SQL语句，存在SQL注入
 * 没有对csrf 进行防御
 * 未对性能进行优化

***

![](snapshots/1.png)

![](snapshots/2.png)

![](snapshots/3.png)

![](snapshots/4.png)

![](snapshots/5.png)

![](snapshots/6.png)

![](snapshots/7.png)

![](snapshots/8.png)
