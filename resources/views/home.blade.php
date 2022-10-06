@extends('layouts.app')


@section('content')
      <div class="container">
        <div class="py-5">


          @if(session()->has('status') && (session('status') === 'success'))

              {{-- Alert --}}
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congratulations!</strong> You have generated {{ session('new_spiral') }} Random Spiral.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

          @elseif (session()->has('status') && (session('status') === 'error'))    
      
              {{-- Alert --}}
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sorry</strong>, you have reached the maximum limit of generating spirals.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          @else

          @endif


          
        @if (!empty($status) && $status == 'warning')    
          
              {{-- Alert --}}
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                There are no Spirals found, please click the <strong>Generate Random Spiral</strong>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

        @endif
          <div id="app">
                  {{-- Vue Spiral Component --}}
                  <spiral-component></spiral-component>
          </div> {{-- End of Vue Div App --}}
      
        </div>
      </div>
    </div>

@endsection