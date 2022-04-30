@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code',  '404')
@section('message',Config::get('app.locale') == 'ar' ?   'لاتوجد نتائج 😥': 'No results 😥')
