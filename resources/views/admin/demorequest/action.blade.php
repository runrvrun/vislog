<form method="GET" action="{{ url('admin/demorequest/delete/'.$dt->id) }}">
<a href="{{ url('admin/demorequest/'.$dt->id.'/edit') }}" class="success p-0" data-original-title="" title="">
        <i class="ft-edit-2 font-medium-3 mr-2"></i>
    </a>
    <a class="danger p-0" onclick="if(confirm('Hapus data ini?')) this.closest('form').submit()">
        <i class="ft-x font-medium-3 mr-2"></i>
    </a>
</form>