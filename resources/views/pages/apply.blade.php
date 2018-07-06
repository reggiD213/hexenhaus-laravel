@extends('layouts.main')

@section('title')
    Hexenhaus e.V {{-- TODO: insert dynamic title --}}
@endsection


@section('content')
    <h2>Infos für Bands</h2>
    <hr>
    @include('includes.infobox')
    <div class="box">
        <p>
            Natürlich sollen auch Konzerte bei uns stattfinden. Ihr habt Lust bei uns zu spielen?
            Hier findet ihr ein paar "Richtlinien", die euch als Band interessieren sollten.
            Diese Richtlinien sind keine unveränderlichen Regeln, auf die wir beharren,
            sondern können gerne nochmals mit uns besprochen werden, solltet ihr sie nicht komplett erfüllen können.
        </p>
        <p>
            Diese sehen wie folgt aus:
        </p>
        <ul>
            <li>Ihr Spielt auf den Eintritt, das heißt ihr bekommt nur soviel Geld, wie durch den Eintritt eingenommen wird. Dabei wird das Geld mit jeder Band, welche an dem Abend spielt geteilt. (Umso mehr Leute kommen, umso mehr Kohle!)</li>
            <li>Ihr verbreitet keine rechtsradikalen Materialien und spielt auch keine Lieder mit rechtsradikalen Inhalten, das selbe gilt für linksradikale Materialien und Inhalte (Einzige unveränderliche Regel! Wir vertreten keine extremen politische Meinungen!)</li>
            <li>Solltet ihr Merchandising Artikel verkaufen wollen, gebt uns bitte vorher Bescheid!</li>
        </ul>

        <p>
            Ihr spielt in einer <strong>Metal</strong> -Band? Bewerbt euch einfach unter:
        <h3><script>document.write('<'+'a'+' '+'h'+'r'+'e'+'f'+'='+"'"+'m'+'&'+'#'+'9'+'7'+';'+'i'+'l'+'t'+'&'+'#'+'1'+'1'+'1'+';'+'&'+
                    '#'+'5'+'8'+';'+'m'+'&'+'#'+'1'+'0'+'1'+';'+'t'+'&'+'#'+'9'+'7'+';'+'l'+'g'+'i'+'&'+'#'+'1'+'0'+'3'+
                    ';'+'s'+'&'+'#'+'6'+'4'+';'+'h'+'%'+'6'+'5'+'%'+'7'+'&'+'#'+'5'+'6'+';'+'e'+'&'+'#'+'3'+'7'+';'+'6'+
                    'E'+'%'+'6'+'8'+'%'+'&'+'#'+'5'+'4'+';'+'1'+'%'+'7'+'5'+'&'+'#'+'1'+'1'+'5'+';'+'-'+'&'+'#'+'1'+'0'+
                    '9'+';'+'%'+'&'+'#'+'5'+'4'+';'+'5'+'t'+'%'+'6'+'1'+'&'+'#'+'1'+'0'+'8'+';'+'&'+'#'+'4'+'6'+';'+'d'+
                    'e'+"'"+'>'+'&'+'#'+'1'+'0'+'9'+';'+'e'+'t'+'&'+'#'+'9'+'7'+';'+'l'+'g'+'i'+'g'+'s'+'&'+'#'+'6'+'4'+
                    ';'+'h'+'e'+'x'+'&'+'#'+'1'+'0'+'1'+';'+'n'+'h'+'a'+'u'+'s'+'-'+'m'+'e'+'t'+'a'+'l'+'&'+'#'+'4'+'6'+
                    ';'+'d'+'e'+'<'+'/'+'a'+'>');</script><noscript>[Turn on JavaScript to see the email address]</noscript></h3>
        </p>
        <p>
            Ihr spielt in einer <strong>Rock, Stoner, Doom</strong> -Band? Bewerbt euch einfach unter:
        <h3><script>document.write('<'+'a'+' '+'h'+'r'+'e'+'f'+'='+"'"+'m'+'a'+'i'+'l'+'t'+'o'+'&'+'#'+'5'+'8'+';'+'g'+'o'+'o'+'d'+'&'+
                    '#'+'3'+'7'+';'+'6'+'F'+'%'+'6'+'C'+'d'+'&'+'#'+'1'+'1'+'5'+';'+'h'+'i'+'t'+'&'+'#'+'6'+'4'+';'+'%'+
                    '&'+'#'+'5'+'4'+';'+'8'+'&'+'#'+'1'+'0'+'1'+';'+'x'+'%'+'&'+'#'+'5'+'4'+';'+'5'+'n'+'&'+'#'+'1'+'0'+
                    '4'+';'+'%'+'&'+'#'+'5'+'4'+';'+'1'+'&'+'#'+'1'+'1'+'7'+';'+'%'+'&'+'#'+'5'+'5'+';'+'3'+'%'+'2'+'&'+
                    '#'+'6'+'8'+';'+'m'+'%'+'6'+'5'+'t'+'a'+'&'+'#'+'1'+'0'+'8'+';'+'&'+'#'+'4'+'6'+';'+'d'+'%'+'6'+'5'+
                    "'"+'>'+'&'+'#'+'1'+'0'+'3'+';'+'o'+'o'+'d'+'o'+'l'+'&'+'#'+'1'+'0'+'0'+';'+'&'+'#'+'1'+'1'+'5'+';'+
                    'h'+'i'+'t'+'&'+'#'+'6'+'4'+';'+'&'+'#'+'1'+'0'+'4'+';'+'e'+'x'+'e'+'n'+'h'+'a'+'u'+'&'+'#'+'1'+'1'+
                    '5'+';'+'-'+'&'+'#'+'1'+'0'+'9'+';'+'&'+'#'+'1'+'0'+'1'+';'+'t'+'a'+'&'+'#'+'1'+'0'+'8'+';'+'&'+'#'+
                    '4'+'6'+';'+'&'+'#'+'1'+'0'+'0'+';'+'e'+'<'+'/'+'a'+'>');</script><noscript>[Turn on JavaScript to see the email address]</noscript></h3>
        </p>
        <hr>
        <p>
            Für Privatevermietungen steht das Hexenhaus leider nicht zur Verfügung!
        </p>
        <hr>
        <p>
            Technical Rider auf Anfrage.
        </p>
    </div>

@endsection

@section('sidebar')
    @include('includes.regular')
@endsection