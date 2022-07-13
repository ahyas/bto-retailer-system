@extends('layout/app')

@section('content')
<body>
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card" id="card">
                <div class="card-header" id="card-header">
                    <span id="header-title">Dashboard</span>
                </div>
                <div class="card-body" id="card-body">
                    <p>Selamat datang di halaman dashboard, <strong>{{ Auth::user()->name }}</strong></p>                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection     

@push('script')
<script type="text/javascript">

</script>
@endpush