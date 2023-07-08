@extends('layouts.store.store-base')
@section('title', $company->corporate_reason)
@section('content-page')
    <livewire:store.products.all :products="$company->products"/>
@endsection