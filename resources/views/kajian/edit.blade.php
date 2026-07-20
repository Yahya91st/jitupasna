<form action="{{ route('kajian.update', $kajian) }}" method="POST">

    @csrf
    @method('PUT')

    @include('kajian._form')

</form>