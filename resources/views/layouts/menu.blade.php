
<li class="{{ Request::is('operators*') ? 'active' : '' }}">
    <a href="{!! route('operators.index') !!}"><i class="fa fa-edit"></i><span>Operators</span></a>
</li>

<li class="{{ Request::is('contacts*') ? 'active' : '' }}">
    <a href="{!! route('contacts.index') !!}"><i class="fa fa-edit"></i><span>Contacts</span></a>
</li>

<li class="{{ Request::is('estimates*') ? 'active' : '' }}">
    <a href="{!! route('estimates.index') !!}"><i class="fa fa-edit"></i><span>Estimates</span></a>
</li>

<li class="{{ Request::is('documents*') ? 'active' : '' }}">
    <a href="{!! route('documents.index') !!}"><i class="fa fa-edit"></i><span>Documents</span></a>
</li>

<li class="{{ Request::is('flows*') ? 'active' : '' }}">
    <a href="{!! route('flows.index') !!}"><i class="fa fa-edit"></i><span>Flows</span></a>
</li>

<li class="{{ Request::is('newdocuments*') ? 'active' : '' }}">
    <a href="{!! route('newdocuments.index') !!}"><i class="fa fa-edit"></i><span>Newdocuments</span></a>
</li>

<li class="{{ Request::is('newlegals*') ? 'active' : '' }}">
    <a href="{!! route('newlegals.index') !!}"><i class="fa fa-edit"></i><span>Newlegals</span></a>
</li>

<li class="{{ Request::is('operations*') ? 'active' : '' }}">
    <a href="{!! route('operations.index') !!}"><i class="fa fa-edit"></i><span>Operations</span></a>
</li>

