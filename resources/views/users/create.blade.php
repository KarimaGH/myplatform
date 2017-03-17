<div class="col-sm-6 field">
    <div class="input-group{{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
        {!! Form::label('name', 'Name', ['class' => 'input-group-addon']) !!}
        {!! Form::text('name', null , ['id' => 'name', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
        @if($errors->has('name'))
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        @endif
    </div>
    @if($errors->has('name'))
        <span class="help-block">{{ $errors->first('name') }}</span>
    @endif
</div>
<div class="col-sm-6 field">
    <div class="input-group{{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
        {!! Form::label('email', 'Email', ['class' => 'input-group-addon']) !!}
        {!! Form::text('email', null , ['id' => 'email', 'placeholder' => 'Email', 'class' => 'form-control']) !!}
        @if($errors->has('email'))
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        @endif
    </div>
    @if($errors->has('email'))
        <span class="help-block">{{ $errors->first('email') }}</span>
    @endif
</div>
<div class="col-sm-6 field">
    <div class="input-group{{ $errors->has('password') ? ' has-error has-feedback' : '' }}">
        {!! Form::label('password', 'Password', ['class' => 'input-group-addon']) !!}
        {!! Form::text('password', null , ['id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control']) !!}
        @if($errors->has('password'))
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        @endif
    </div>
    @if($errors->has('password'))
        <span class="help-block">{{ $errors->first('password') }}</span>
    @endif
</div>