<form action="{{ route('kajian.store', $laporan) }}" method="POST">

    @csrf

    @include('kajian._form')

</form>
