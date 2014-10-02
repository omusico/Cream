@if ($entity->comment)

    <!-- #companyDescription -->

    <div id="companyDescription">
        
        <h1>observaciones</h1>
        <p>{{ $entity->comment }}</p>

    </div>
    
    <!-- /#companyDescription -->

@endif