$file = ".\resources\views\uk-car-booking.blade.php"
# Read with UTF8 encoding to prevent data loss
$linesArray = Get-Content $file -Encoding UTF8

# Head: 1 to 6674
$headLines = $linesArray[0..6673]
# Nav: 6675 to 6758
$navLines = $linesArray[6674..6757]
# Content: 6759 to 8300
$contentLines = $linesArray[6758..8299]
# Footer: 8301 to 8385
$footerLines = $linesArray[8300..8384]
# Scripts: 8386 to EOF
$scriptLines = $linesArray[8385..($linesArray.Length - 1)]

$utf8NoBom = New-Object System.Text.UTF8Encoding $false

# Write partials
[System.IO.File]::WriteAllLines((Resolve-Path ".\resources\views\partials\header.blade.php").Path, $navLines, $utf8NoBom)
[System.IO.File]::WriteAllLines((Resolve-Path ".\resources\views\partials\footer.blade.php").Path, $footerLines, $utf8NoBom)

# Write layout
$layout = @()
$layout += $headLines
$layout += "@include('partials.header')"
$layout += "@yield('content')"
$layout += "@include('partials.footer')"
$layout += $scriptLines
[System.IO.File]::WriteAllLines((Resolve-Path ".\resources\views\layouts\app.blade.php").Path, $layout, $utf8NoBom)

# Write new uk-car-booking.blade.php
$newBooking = @()
$newBooking += "@extends('layouts.app')"
$newBooking += "@section('content')"
$newBooking += $contentLines
$newBooking += "@endsection"
[System.IO.File]::WriteAllLines((Resolve-Path ".\resources\views\uk-car-booking.blade.php").Path, $newBooking, $utf8NoBom)

Write-Host "Done splitting!"
