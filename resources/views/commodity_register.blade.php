@extends('layouts.app')
@section('title', '商品登録')
@section('content')
<div class="register-com">
    <div class="title-com col-md-8 col-md-offset-2">
        <h2>商品登録フォーム</h2>
        <form method="POST" action="{{ route('exestore') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
        @csrf

        <div class="form-com">
            <div class="name-com">
                <label for="name">商品名</label><br>
                <input id="name" type="text" name="product_name">
            </div>

            <div class="maker-com">
                <label for="maker">メーカー</label><br>
                <select id="maker" name="company_id">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach    
                </select>
            </div>

            <div class="price-com">
                <label for="price">価格</label><br>
                <input id="price" type="text" name="price">
            </div>

            <div class="inventory-com">
                <label for="inventory">在庫数</label><br>
                <input id="inventory" type="text" name="stock">
            </div>

            <div class="comment-com">
                <label for="comm">コメント</label><br>
                <textarea name="comment" id="comm" cols="30" rows="10"></textarea>
            </div>

            <div class="picture-com">
                <label for="pic">商品画像</label><br>
                <input id="pic" type="file" name="img_path">
            </div>

            <div class="regist">
                <button type="submit" name="regist">登録</button>
            </div>

            <div class="return">
            <a href="{{ route('list')}}"><input type="button" name="" id="" value="戻る"></a>
            </div>
            
        </div>
        
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
