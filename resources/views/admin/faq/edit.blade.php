@extends('layouts.app')
@section('title', 'FAQ Bewerken - Admin')
@section('content')
@include('admin.faq.form', ['faq' => $faq, 'action' => route('admin.faq.update', $faq->id), 'method' => 'PUT', 'submitText' => 'FAQ Bijwerken'])
@endsection
