webpack

[https://webpack.docschina.org/concepts/](https://webpack.docschina.org/concepts/)

webpack基于node开发，借助于webpack这个前端自动化构建工具，可以完美实现资源的合并，打包，压缩等诸多功能。

## 入口

* 单文件入口

  ```
  module.exports = {
    // 单文件入口
    entry: './src/main.js'
  };
  ```

* 对象写法

  ```
  module.exports = {
    // 多文件入口
    entry: {
      main: './scr/main.js'
    }
  };
  
  ```

## 输出

* 用法

```
output: {
  // 将最终整合完成的bundle文件存放到dist文件夹下
  filename: 'bundle.js'
}
```

* 如果配置了多个入口文件

  ```
  module.exports = {
    entry: {
      app: './src/app.js',
      search: './src/search.js'
    },
    output: {
      filename: '[name].js',
      path: __dirname + '/dist'
    }
  };
  
  // 写入到硬盘：./dist/app.js, ./dist/search.js 
  ```

  

## 模式

## loader

## 插件

* plugins (array)

## 模块

1. 处理css

   ```
   import './index.css'
   ```

   ```
   module: {
   	// 所有第三方加载器匹配规则
   	rules: [
   	// 调用规则，从后往前调用
   		{ test: /\.css$/, use: ['style-loader', 'css-loader']}
   	]
   }
   ```

2. 处理js

3. 处理image

   *  ulr-loader

   * 会自动转成base64

     ```
     module: {
     	rules: [
     		{ test: '\.(jpg|png|gif|jpeg|bmp)$', use: 'url-loader'}
     	]
     }
     ```

   * 参数设置

     * limit 单位是byte
     * name=[name]-\[hash:8] .[ext] 文件名设置

     ```
     { test: /.(jpg|png|gif|jpeg|bmp)$/, use: 'url-loader?limit=1024'
     ```

4. 处理字体

   ```
   { test: /\.(ttf|eot|svg|woff|woff2)$/, use:'url-loader'}
   ```

   

## 工具

1. webpack-dev-server(本地安装)

   * 实时监听文件改变进行编译，自动刷新浏览器

   * package.json的scripts里添加执行命令

     ```
     scrips:{
     	dev: 'webpack-dev-server'
     }
     ```

   * 此工具需在本地安装，并且依赖本地webpack

   * 默认编译后文件路径为根目录，为虚拟文件，实际数据保存在内存中

   * 相关指令

     * 通过package.json

     ```
     // --opon 自动打开浏览器
     // --port 设置服务端口
     // --contentBase  指定托管根目录
     // --hot 热更新(局部更新)
     dev: 'webpack-dev-server --open  --port 3000  --contentBase src  --hot'
     ```

     * 通过webpack.config

     ```
     const webpack = require('webpack');
     
     devServer: {
     	open: true,
     	port: 3000,
     	contentBase: 'scr',
     	hot: true
     }，
     plugins: [
     	 new webpack.HotModulsReplacementPlugin()
     ]
     ```

2. html-webpack-plugin

   > 在内存中生成HTML

   1. 本地安装

      ```
      npm i html-wabpack-plugin --save
      ```

   2. 导入html-webpack-plugin

      ```
      const htmlWebpackPlugin = require('html-webpack-plugin')
      ```

   3. 在plugins中启用

      ```
      new htmlWebpackPlugin({
      	//指定模板页面
      	template: './scr/index.html',
      	// 指定生成页面的名称
      	filename: 'index.html'
      })
      ```

3. babel

   * 安装相关包

     ```
     npm i babel-core babel-loader babel-plugin-transform-runtime -D
     
     npm i babel-preset-env babel-preset-stage-0 -D
     ```

   * 修改webpack配置文件

     ```
     { test: /.(js|jxs)$/, use: 'babel-loader', exclude: /node_modules/}
     ```

   * 添加.babelrc文件

     ```
     {
     	"preset": ["env", "stage-0"],
     	plugins: ["'transform-runtime"]
     }
     ```

## webpack中使用vue

1. 设置匹配规则

   ```
   { test: '/.vue$/', use: 'vue-loader'}
   ```

2. 安装vue-loader相关包

   ```
   1. 安装vue包
   2. 安装vue-loader vue-template-complier
   ```

3. 在main.js中导入vue
4. 定义一个vue组件，其中有三部分组成：template  script style
5. 创建一个vm实例，导入vue组件，并调用render函数