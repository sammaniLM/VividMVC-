<?php

interface Middleware
{
    public function handle(\http\Env\Request $request, Closure $next);
}