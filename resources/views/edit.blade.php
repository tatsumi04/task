@extends('layouts.app')
@section('title', '商品情報一覧画面')
@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-2">
      <h2>商品情報編集</h2>
      @if (session('err_msg'))
        <p class="text-denger">
            {{ session('err_msg') }}
        </p>
      @endif

      <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="{{ $product->id }}">
      <div class="com-info"> 

        <div class="name-edit">
            <label for="name">商品名</label><br>
            <input id="name" type="text" name="title" value="{{ $product->title }}">
        </div>
            
        <div class="maker-edit">
            <label for="maker">メーカー名</label><br>
            <select id="maker" name="maker_name" value="{{ $product->maker_name }}">
                <option value="企業A">企業A</option>
                <option value="企業B">企業B</option>
                <option value="企業C">企業C</option>
            </select>
        </div>

        <div class="price-edit">
            <label for="price">価格</label><br>
            <input id="price" type="text" name="price" value="{{ $product->price }}">
        </div>

        <div class="inventory-edit">
            <label for="inventory">在庫数</label><br>
            <input id="inventory" type="text"  name="inventory" value="{{ $product->inventory }}">
        </div>

        <div class="comment-edit">
            <label for="comm">コメント</label><br>
            <textarea name="comment" id="comm" cols="30" rows="10" value="{{ $product->comennt }}"></textarea>
        </div>

        <div class="picture-edit">
            <label for="pic">商品画像</label><br>
            <input id="pic" type="file" name="image_file_name" value="{{ $product->image_file_name }}">
        </div>
        
        <div class="update">
        <button type="submit">更新</button>
        </div>
      </div>
      </form>

      <div class="return">
            <button type="submit" name="" onclick="location.href='/task/public/detail/{{ $product->id }}'">戻る</button>
      </div>

      <script>
      function checkSubmit(){
      if(window.confirm('更新してよろしいですか？')){
        return true;
      } else {
        return false;
      }
      }
      </script>
@endsection