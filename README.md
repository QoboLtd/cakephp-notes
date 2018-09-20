# Notes plugin for CakePHP

[![Build Status](https://travis-ci.org/QoboLtd/cakephp-notes.svg?branch=master)](https://travis-ci.org/QoboLtd/cakephp-notes)
[![Latest Stable Version](https://poser.pugx.org/qobo/cakephp-notes/v/stable)](https://packagist.org/packages/qobo/cakephp-notes)
[![Total Downloads](https://poser.pugx.org/qobo/cakephp-notes/downloads)](https://packagist.org/packages/qobo/cakephp-notes)
[![Latest Unstable Version](https://poser.pugx.org/qobo/cakephp-notes/v/unstable)](https://packagist.org/packages/qobo/cakephp-notes)
[![License](https://poser.pugx.org/qobo/cakephp-notes/license)](https://packagist.org/packages/qobo/cakephp-notes)
[![codecov](https://codecov.io/gh/QoboLtd/cakephp-notes/branch/master/graph/badge.svg)](https://codecov.io/gh/QoboLtd/cakephp-notes)
[![BCH compliance](https://bettercodehub.com/edge/badge/QoboLtd/cakephp-notes?branch=master)](https://bettercodehub.com/)

## About

CakePHP 3+ plugin for simple notes attached to other application records.

This plugin is developed by [Qobo](https://www.qobo.biz) for [Qobrix](https://qobrix.com).  It can be used as standalone CakePHP plugin, or as part of the [project-template-cakephp](https://github.com/QoboLtd/project-template-cakephp) installation.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require qobo/cakephp-notes
```

## Setup
Load plugin
```
bin/cake plugin load --routes Notes
```

Load required plugin(s)
```
bin/cake plugin load Muffin/Trash
```
