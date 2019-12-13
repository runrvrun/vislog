<form method="POST" action="/user/{{$dt->id}}">
{{ csrf_field() }}
{{ method_field('DELETE') }}
    <a class="danger p-0" onclick="if(confirm('Hapus data ini?')) this.closest('form').submit()">
        <i class="ft-x font-medium-3 mr-2"></i>
    </a>
</form>