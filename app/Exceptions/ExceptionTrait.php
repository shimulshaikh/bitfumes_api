<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait
{

	public function apiException($request, $e)
	{
            if ($this->isModel($e)) {
                return $this->modelResponse($e);
            }

	            if ($this->isHttp($e)) {
	                return $this->httpResponse($e);
	            }

		            //if not model & http issue then return
		            return parent::render($request, $exception);
        
	}

	protected function isModel($e)
	{
		return $e instanceof ModelNotFoundException;
	}

	protected function isHttp($e)
	{
		return $e instanceof NotFoundHttpException;
	}

	protected function modelResponse($e)
	{
		return response()->json([
                    'error' => 'Product model not found'
                ],Response::HTTP_NOT_FOUND);
	}

	protected function httpResponse($e)
	{
		return response()->json([
                    'error' => 'Incorrect route'
                ],Response::HTTP_NOT_FOUND);
	}


}