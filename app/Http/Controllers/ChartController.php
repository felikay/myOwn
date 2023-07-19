<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Application;
use App\Models\Products;

class ChartController extends Controller
{

public function adminAnalysis()

{

    // Fetch the user data from the users table
    $userCounts = User::selectRaw('type, COUNT(*) as count')
        ->groupBy('type')
        ->pluck('count', 'type')
        ->toArray();

    // Map the user types to labels
    $userLabels = [
        0 => 'Bidders',
        1 => 'Admins',
        2 => 'Sellers',
    ];

    // Initialize the data array
    $chartData = [];

    // Iterate over the user types and counts
    foreach ($userCounts as $type => $count) {
        $label = $userLabels[$type] ?? 'Unknown';
        $chartData[$label] = $count;
    }

    // Fetch the data from the posteds table
    $postedsData = DB::table('posteds')
        ->select('product_name', 'seller_email', 'reserve_price')
        ->orderBy('reserve_price', 'desc')
        ->limit(7)
        ->get();

    // Prepare the posted chart data
    $postedLabels = $postedsData->pluck('product_name');
    $postedPrices = $postedsData->pluck('reserve_price');
    $postedColors = $this->generateShadesOfGreenBlue(count($postedLabels));

    // Fetch the data from the bids table
    $bidsData = DB::table('bids')
        ->join('posteds', 'bids.product_id', '=', 'posteds.product_id')
        ->select('posteds.product_name', 'posteds.reserve_price', DB::raw('COUNT(*) as bid_count'))
        ->groupBy('posteds.product_name', 'posteds.reserve_price')
        ->orderBy('bid_count', 'desc')
        ->limit(7)
        ->get();

    // Prepare the bids chart data
    $bidsLabels = $bidsData->pluck('product_name');
    $bidsCount = $bidsData->pluck('bid_count');
    $bidsPrices = $bidsData->pluck('reserve_price');
    $maxBidsCount = $bidsCount->max();
    $bidsColors = $this->generateColorGradient($maxBidsCount);

    return view('adminAnalysis', compact('chartData', 'postedLabels', 'postedPrices', 'postedColors', 'bidsLabels', 'bidsCount', 'bidsPrices', 'bidsColors'));
}

private function generateShadesOfGreenBlue($count)
{
    $colors = [];
    $baseColor = [0, 123, 255]; // RGB value for base color
    $increment = 15;

    for ($i = 0; $i < $count; $i++) {
        $currentColor = [
            $baseColor[0] - $i * $increment,
            $baseColor[1] - $i * $increment,
            $baseColor[2] - $i * $increment,
        ];
        $colors[] = 'rgb(' . implode(',', $currentColor) . ')';
    }

    return $colors;
}

private function generateColorGradient($count)
{

    if ($count <= 0) {
        return [];
    }

    $colors = [];
    $startColor = [87, 190, 60]; // RGB value for the starting color
    $endColor = [252, 87, 66]; // RGB value for the ending color

    for ($i = 0; $i < $count; $i++) {
        $color = [
            $startColor[0] + ($i * ($endColor[0] - $startColor[0])) / ($count - 1),
            $startColor[1] + ($i * ($endColor[1] - $startColor[1])) / ($count - 1),
            $startColor[2] + ($i * ($endColor[2] - $startColor[2])) / ($count - 1),
        ];
        $colors[] = 'rgb(' . implode(',', $color) . ')';
    }

    return $colors;
}
}
