@extends('layouts.master')

@section('title', (($objSelectedVintage != null) ? $objSelectedVintage->region_jpn : '') . " ($vintage)")

@section('header_contents')
    <ul>
        <li>
            <a href="//anyway-grapes.jp/store/index.php?pc_view=1&amp;submenu=vintage_info" target="_parent">Wine Vintage Info / <span class="jpnText">ワインのヴィンテージ情報</span></a>
        </li>
        <li>&nbsp;&nbsp;&gt;&gt;</li>
        <li>
            <strong>{{($objSelectedVintage != null) ? $objSelectedVintage->region_jpn : ''}} ({{$vintage}})</strong>
        </li>
    </ul>
@endsection

@section('contents')
    <table style="width:100%;text-align:center;">
        @for ($i = 0; $i < count($rgobjVintage); ++$i)
            @if (($i % 5) == 0)
                <tr>
            @endif
            <td>
                <a style="font-size:12px;" href="{{url('vintages/' . $region . '/' . $rgobjVintage[$i]->vintage)}}">{{$rgobjVintage[$i]->vintage}}</a>
            </td>
            @if ((($i % 5) == 4) || (($i + 1) == count($rgobjVintage)))
                </tr>
            @endif
        @endfor
    </table>
    <br /><br />
    <h2>{{($objSelectedVintage != null) ? $objSelectedVintage->region_jpn : ''}} ({{$vintage}})</h2>
    <p>{!! ($objSelectedVintage != null) ? $objSelectedVintage->contents : '' !!}</p>
    <span style="color:rgb(150,150,150);">[参照元: {{($objSelectedVintage != null) ? $objSelectedVintage->reference: ''}}]</span>
@endsection
