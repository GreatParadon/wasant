<?php

if (!function_exists('userId')) {

    function userId($request)
    {
        return $request->session()->get('user_id');
    }
}

if (!function_exists('filePath')) {

    function filePath($path = null, $filename = null)
    {
        return asset('content/' . $path . '/' . $filename);
    }
}

if (!function_exists('fileUpload')) {

    function fileUpload($file = null, $uploadPath = null)
    {
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $uniqid = uniqid($name);
        $strlen = strlen($name);
        $substr = substr($uniqid, $strlen);
        $filename = $substr . '.' . $ext;
        if ($file->isValid()) {
            $upload = \Storage::put($uploadPath . '/' . $filename, file_get_contents($file->getRealPath()),
                'public');
            if ($upload) {
                return success(['filename' => $filename]);
            } else {
                return error('Failed');
            }
        } else {
            return error('Image file is invalid');
        }
    }
}

if (!function_exists('success')) {

    function success($message = null)
    {
        return result($message, true);
    }
}

if (!function_exists('error')) {

    function error($message = null)
    {
        return result($message, false);
    }
}

if (!function_exists('result')) {

    function result($message, $boolean)
    {
        $result['success'] = $boolean;
        if (is_array($message)) {
            $result = $result + $message;
        } else {
            $result['message'] = $message;
        }

        return $result;
    }
}

