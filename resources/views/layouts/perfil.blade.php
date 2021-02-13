<div class="user_div">
    <h5 class="brand-name mb-4">User<a href="javascript:void(0)" class="user_btn"><i class="icon-close"></i></a></h5>
    <div class="card">

        <div class="right ">
            <div class="notification d-flex">
                <a class="btn btn-facebook" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off mr-2 font-size-16 align-middle mr-1"></i> Salir</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        
        <div class="card-body">
            <h5 class="card-title">Arca Tech</h5>
        </div>
    </div>
</div>