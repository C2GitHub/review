# Electron

### 脚手架工具

```
# 克隆示例项目的仓库
$ git clone https://github.com/electron/electron-quick-start

# 进入这个仓库
$ cd electron-quick-start

# 安装依赖并运行
$ npm install && npm start
```



### 什么是Process - 进程

每一个运行的程序就会创建一个进程。

### 什么是Thread - 线程

线程是操作系统能够进行运算调度的最小单位。一个线程可以包含多个线程。

### Electron主进程和渲染进程

### nodemon实现热更新

```
# 修改package.json

"start" : "nodemon --watch main.js --exec \"electron .\""
```

### 安装Devtron

```
$ npm install --save-dev devtron

require('devtron').install()

mainWindow.webContents.openDevTools()
```

### 进程之间的通讯方式

#### 使用IPC进行进程间的通讯

* render进程

  ```
  
  const { ipcRenderer } = require('electron')
  
  ipcRenderer.send('message', 'hello')
  
  ipcRenderer.on('reply', (event, arg) => {
  	console.log(event, arg)
  })
  ```

* main进程

  ```
  const { ipcMain } = require('electron')
  
  ipcMain.on('message', (event, arg) => {
  	event.reply('reply', 'hi')
  })
  ```

  

#### 使用remote进行通讯

```
#render进程
const { BroswerWindow } = require('electron').remote
```

## 原生事件

* ready
* closed : 窗口关闭
* window-all-closed: 所有窗口关闭
* activate： 窗口激活

