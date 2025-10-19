@extends('layouts.app')
@section('title', 'Nieuwe FAQ - Admin')
@section('content')
@include('admin.faq.form', ['faq' => null, 'action' => route('admin.faq.store'), 'method' => 'POST', 'submitText' => 'FAQ Aanmaken'])
@endsection
