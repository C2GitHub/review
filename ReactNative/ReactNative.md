# ReactNative

[https://reactnative.dev/docs/environment-setup](https://reactnative.dev/docs/environment-setup)

## 开发环境搭建

* 安装Node.js

  [https://nodejs.org/en/](https://nodejs.org/en/)


### **React Native CLI**

1. 安装React Native命令行工具

   ```
   npm install -g react-native-cli
   ```

2. 下载安装Android Studio 

   [https://developer.android.google.cn/studio](https://developer.android.google.cn/studio)

3. 安装Genymotion模拟器

   [https://www.genymotion.com/download/](https://www.genymotion.com/download/)

   [安装教程https://blog.csdn.net/yht2004123/article/details/80146989](https://blog.csdn.net/yht2004123/article/details/80146989)

## 创建第一个React Native应用

1. 利用React Native命令行工具初始化一个项目

   ```
   react-native init myapp
   ```

2. 运行初始化的项目

   ```
   npm start
   ```

3.  运行Android Studio 和开启Genymotion模拟器

## react-navigation使用

[https://reactnavigation.org/docs/getting-started](https://reactnavigation.org/docs/getting-started)

1. 安装

   ```
   1. 安装react-navigation
   npm install @react-navigation/native
   
   2. 安装react-native-gesture-handler
   npm install --save react-native-gesture-handler
   
   3. 两个进行链接
   react-native link react-native-gesture-handler
   ```


## RN网络编程

React Native提供了一套和web标准一致的Fetch API，拥有开发者访问网络需求。

## AsyncStorage本地存储