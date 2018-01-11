@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <p>
            <form action="{{asset('add')}}" method="post">
                <div>
                    <input type="text" name="name" class="form-control"  placeholder="Име на продукта" />
                </div>
                <div>
                    <label>Цена/лв:</label>
                    <input type="number" step="0.01" class="form-control"  name="price" min="0"/>
                </div>
                <div>
                    <textarea placeholder="Описание..." class="form-control"  name="description"></textarea> 
                </div>
                <select class="form-control" name="country">
                    @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                @if($errors->any())
                <h4 class="alert alert-danger">{{$errors->first()}}</h4>
                @endif

                @if (Session::has('success'))
                   <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <input type="submit" value="Добави">
            </form>
            </p>
            <form>
                <select name="sort_price" id="sort_price">
                    <option>Сортирай по цена</option>
                    <option value="asc" @if($sort ==  "asc") selected="selected" @endif>Ниска</option>
                    <option value="desc" @if($sort ==  "desc") selected="selected" @endif>Висока</option>
                </select>
                <input type="submit" value="Сортирай">
            </form>
            <div class="panel panel-default">
                <div class="panel-heading">Продукти</div>
                
                <div class="panel-body items">
                    @foreach($items as $item)
                        <div class="item-{{$item->id}}">

                        <div>
                            <h2>{{$item->name}}</h2>
                            <p>{{$item->description}}</p>
                            <b>Цена: {{$item->price}}лв.</b>
                            <p><b>Произведено: {{$item->country_object->name}}</b></p>
                            
                        </div>
                        <a href="{{asset('edit/'.$item->id)}}">Редакция</a>
                        <button class="btn btn-danger" onclick="deleteAction({{$item->id}})">Изтриване</button>
                        <hr>
                        </div>
                    @endforeach

                </div>

                <div class="hide-item" style="display: none;">

                        <div>
                            <h2 class="item_name"></h2>
                            <p class="item_description"></p>
                            <b class="item_price"></b>
                            <p><b class="item_country"></b></p>
                            
                        </div>
                        <a href="" class="item_edit_btn">Редакция</a>
                        <button class="btn btn-danger item_delete_btn" onclick="" >Изтриване</button>
                        <hr>
                        </div>

                </div>
             <p class="btn btn-default col-md-offset-5" onclick="pagination.show(this)">Още продукти</p>
        </div>
    </div>
</div>
@endsection
