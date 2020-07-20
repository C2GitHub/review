# react-Study

react学习总结

## webpack配置

1. 初始化pakeages.json

   ```
   npm init -y  // 快速初始化
   ```

2. 项目目录安装webpack

   ```
   npm i webpack webpack-cli -D
   ```

3. 安装webpack-dev-server

   * 启动webpack-server服务
   * 配置项：
     * --open 自动打开浏览器
     * --hot 热更新
     * --port 3000 指定端口
     * --host 127.0.0.1 指定域名
     * --compress 压缩

   ```
   // 1.安装
   npm i webpack-dev-server -D
   // 2.配置
   // 2.1 修改packages.json
   // 2.2 scripts中添加启动项
   // "dev": "webpack-dev-server --open --hot --port 3000"
   ```

4. 安装html-webpack-plugins

   * 安装依赖
   * 在webpack.config.js中配置插件

