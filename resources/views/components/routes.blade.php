<script type="text/javascript">
    var updateprofileroute = "{{ route('updateprofile', ['id' => Auth::user()->id]) }}";
    var editprofileroute = "{{ route('editprofile', ['id' => Auth::user()->id]) }}";
    var storeproductroute = "{{ route('storeproduct', ['id' => Auth::user()->id]) }}";
</script>