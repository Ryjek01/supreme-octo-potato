<!DOCTYPE html>
<html>
<head>
    <title>Costam</title>
    <link type="text/css" href="{$server}/asset/css/bootstrap-theme.min.css" rel="stylesheet">
    <link type="text/css" href="{$server}/asset/css/bootstrap.min.css" rel="stylesheet">
    {foreach from=$allCss item=item}
        <link type="text/css" href="{$server}/asset/css/modules/{$item}" rel="stylesheet">
    {/foreach}

    <script src="{$server}/js/jquery-3.1.1.min.js"></script>
    <script src="{$server}/js/bootstrap.min.js"></script>

    {foreach from=$allJs item=item}
        <script src="{$server}/js/modules/{$item}"></script>
    {/foreach}
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="" class="navbar-brand">123</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="/index/">Home</a></li>
            <li><a href="/test/">test</a></li>
            <li><a href="">123</a></li>
            <li><a href="">123</a></li>
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
