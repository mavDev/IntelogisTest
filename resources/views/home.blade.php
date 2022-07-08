@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="row g-3" method='post' action="{{route("calculate")}}">
            @csrf
            <div class="col-12">

                <label for="inputFrom" class="form-label">Откуда</label>
                <input class="form-control {!! !$errors->has('inputFrom')?:'is-invalid' !!}" value="{{ old('inputFrom') }}" list="datalistOptionsFrom"
                       id="inputFrom" name="inputFrom" placeholder="Укажите город отправления...">
                <datalist id="datalistOptionsFrom">
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </datalist>
                @error('inputFrom')
                <div id="inputFromFeedback" class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror

            </div>
            <div class="col-12">
                <label for="inputTo" class="form-label">Куда</label>
                <input class="form-control  {!! !$errors->has('inputTo')?:'is-invalid' !!}" value="{{ old('inputTo') }}" list="datalistOptionsTo" id="inputTo" name="inputTo"
                       placeholder="Укажите город назначения...">
                <datalist id="datalistOptionsTo">
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </datalist>
                @error('inputTo')
                <div id="inputToFeedback" class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror

            </div>

            <div class="col-12">
                <label for="weight" name="packageWeight" class="form-label">Выберете вес отправления</label>
                <div class="row">
                    <div class="col-8">
                        <input type="range" class="form-range" value="{{old('packageWeight',5)}}" min="0" max="30" step="1" id="package_weight_range">
                    </div>
                    <div class="col-1">
                        <input type="input" id="packageWeight" name="packageWeight" value="{{old('packageWeight',5)}}" class="form-control">
                    </div>
                    <div class="col-auto">
                        кг
                    </div>
                </div>

                <script>

                </script>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Рассчитать</button>
            </div>

        </form>
        
        
        @if (isset($data->calcFast))
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Стоимость</th>
                    <th scope="col">Примерная дата</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>{{$data->calcFast->price}} ₽</td>
                    <td>{{$data->calcFast->date}}</td>
                </tr>
                @if (isset($data->calcSlow))
                    <tr>
                        <th scope="row">2</th>
                        <td>{{$data->calcSlow->price}} ₽</td>
                        <td>{{$data->calcSlow->date}}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        @endif
        
    </div>
@endsection
