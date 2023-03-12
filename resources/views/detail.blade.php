@extends('layouts.app')
@section('title', '商品情報')
@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-2">
  <h2>商品情報</h2>
      @if (session('err_msg'))
        <p class="text-denger">
            {{ session('err_msg') }}
        </p>
      @endif

      <div class="commodity-detail">
        <p>商品画像</br><img src="{{ asset('storage/'.$product->img_path) }}" class="img" height="300" width="300"></p>

        <p>商品名</br>{{ $product->product_name }}</p>
        <p>メーカー名</br>{{ $product->company_id }}</p>
        <p>価格</br>{{ $product->price }}</p>
        <p>在庫数</br>{{ $product->stock }}</p>
        <p>コメント</br>{{ $product->comment }}</p>
      </div>


      <div class="edit">
        <button type="submit" onclick="location.href='/task/public/edit/{{ $product->id }}'">編集</button>
      </div>
      
      <div class="return">
        <button type="submit" name="" onclick="location.href='{{ route('list') }}'">戻る</button>
      </div>
@endsection