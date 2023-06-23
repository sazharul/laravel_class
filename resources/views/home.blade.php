@extends('layouts.app')

@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                @foreach($products as $item)
                    <div class="col-md-12 col-lg-4 mb-4">
                        <div class="card">
                            <div class="d-flex justify-content-between p-3">
                                <p class="lead mb-0">{{ substr($item->name, 0, 30) }} ..</p>
                            </div>
                            <img style="height: auto; max-height: 200px;" src="{{ asset($item->image) }}"
                                 class="card-img-top" alt="Laptop"/>
                            <div class="card-body">
{{--                                <div class="d-flex justify-content-between">--}}
{{--                                    <p class="small">--}}
{{--                                        <a href="#!" class="text-muted">{{ (isset($item->brand)) ? $item->brand->name : '' }}</a>--}}
{{--                                    </p>--}}
{{--                                </div>--}}

                                <div class="d-flex justify-content-between mb-3">
{{--                                    <h5 class="mb-0">{{ (isset($item->category)) ? $item->category->name : '' }}</h5>--}}
                                    <h5 class="text-dark mb-0">BDT {{ $item->price }}</h5>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <a href="#" class="btn btn-primary">Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
