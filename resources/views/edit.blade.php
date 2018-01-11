@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Редакция</h2>
            <form action="{{asset('store')}}" method="post">
                <div>
                    <input type="text" name="name" class="form-control"  value="{{$item->name}}" />
                </div>
                <div>
                    <label>Цена/лв:</label>
                    <input type="number" step="0.01" class="form-control"  name="price" min="0" value="{{$item->price}}" />
                </div>
                <div>
                    <textarea placeholder="Описание..." class="form-control"  name="description">{{$item->description}}</textarea> 
                </div>
                <select class="form-control" name="country">
                    @foreach($countries as $country)
                        
                        @if($country->id == $item->country)
                        <option value="{{$country->id}}" selected="selected">{{$country->name}}</option>
                        @else
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endif
                    @endforeach
                </select>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="id" value="{{$item->id}}">
                @if($errors->any())
                <h4 class="alert alert-danger">{{$errors->first()}}</h4>
                @endif

                @if (Session::has('success'))
                   <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <input type="submit" value="Редактирай">
            </form>
           
        </div>
    </div>
</div>
@endsection
