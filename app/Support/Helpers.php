<?php

/**
 * Retrieve File from Storage
 * @param  [type] $filename [Name of File]
 * @param  [type] $type     [Resume or Report File]
 * @return [type]           [File]
 */
function findFile($filename,$type)
{
	
	$file = Storage::get($type .'/'. $filename . '.pdf');
    $response = Response::make($file, 200);            
    $response->header('Content-Type', 'application/pdf');
    
    return $response;
}

// Create Resume or Report File
function generateFile($type,$file,$fileCount,$totalCount)
{	
	$response = [];
    $tempFile = $file;
    $extension = $tempFile->getClientOriginalExtension();
    
    if($type == 'resume') {
    	$response['fileName'] = 'Resume-' . ++$totalCount;
    } else {
    	$response['fileName'] = 'Report-' . ++$totalCount;
    }
    
    $response['fileAlias'] = createAlias($fileCount, $type);

    return $response;
}

// Generate Iteration Number to Word
function createAlias($count,$type)
{	
	$number = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);    
    // $count = $user->resumes()->count();
    $iteration = $number->format($count + 1);        
    if($type == 'resume')
    {
    	$fileAlias = 'resume-draft-'. $iteration; 
    } else {
    	$fileAlias = 'report-'. $iteration; 
    }
    
    return $fileAlias;
}