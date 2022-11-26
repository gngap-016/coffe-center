@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            $.notify({message: "{{ ucfirst($error) }}",},
            {
                type:'danger',
                allow_dismiss:false,
                newest_on_top:true ,
                mouse_over:true,
                showProgressbar:false,
                spacing:10,
                timer:2000,
                placement:{from:'top',align:'center'},
                offset:{x:30,y:30},
                delay:1000 ,
                z_index:10000,
                animate:{enter:'animated flash',exit:'animated swing'}
            });
        @endforeach
    </script>
@endif
@if ($message = Session::get('error'))
    <script>
        $.notify({message: "{{ $message }}",},
        {
            type:'danger',
            allow_dismiss:false,
            newest_on_top:true ,
            mouse_over:true,
            showProgressbar:false,
            spacing:10,
            timer:2000,
            placement:{from:'top',align:'center'},
            offset:{x:30,y:30},
            delay:1000 ,
            z_index:10000,
            animate:{enter:'animated flash',exit:'animated swing'}
        });
    </script>
@elseif ($message = Session::get('success'))
    <script>
        $.notify({message: "{{ $message }}",},
        {
            type:'success',
            allow_dismiss:false,
            newest_on_top:true ,
            mouse_over:true,
            showProgressbar:false,
            spacing:10,
            timer:2000,
            placement:{from:'top',align:'center'},
            offset:{x:30,y:30},
            delay:1000 ,
            z_index:10000,
            animate:{enter:'animated flash',exit:'animated swing'}
        });
    </script>
@endif


