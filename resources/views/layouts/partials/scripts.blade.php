<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="{{asset('assets/bundles/izitoast/js/iziToast.min.js')}} "></script>
<script src="{{asset('assets/bundles/prism/prism.js')}}"></script>
{{-- @stack('script') --}}
<script src="{{asset('assets/js/page/index.js')}}"></script>
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>

<script>
    function deleteConfirmation(itemType, itemId) {
        if (confirm(`Êtes-vous sûr de vouloir supprimer ce (t) ${itemType} ?`)) {
            document.getElementById(`delete-${itemId}`).submit();
        }
    }

//------------- pour  deselectionner le champ select de l'affection d'articles a un atelier---------
 
    function deselectionner(){
        const select_articles=document.getElementById('selectArticles');
    
        select_articles.addEventListener('click',function(){
            select_articles.selectedIndex=-1;
        })
    }

    

</script>