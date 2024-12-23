<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="copyright" content="Copyright(c) Simplex Internet Inc.All Rights Reserved.">
    <title>블랭커</title>
    <style>
        @charset "utf-8";
        @import url('https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700&family=Noto+Sans+KR:wght@400;500;700&display=swap');
        @import "width.css";
        @import "icon.css";

        @font-face {
            font-family: "Noto Sans KR";
            src: local("Arial");
            unicode-range: U+0041-007A;
        }

        /* Reset */
        html, body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td, img {
            margin: 0;
            padding: 0;
        }

        html {
            width: 100%;
            height: 100%;
        }

        body, code {
            font-size: 12px;
            font-family: "Noto Sans KR", "맑은 고딕", "malgun gothic", "Apple SD Gothic Neo", sans-serif;
            color: #1b1e26;
            -webkit-text-size-adjust: none;
            background-color: #f4f5f8;
        }

        html:lang(ko) body, html:lang(ko) code {
            font-size: 13px;
            letter-spacing: -0.5px;
        }

        html:lang(ja) body, html:lang(ja) code {
            word-spacing: -1px;
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) body, html:lang(vi) code {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) body, html:lang(en) code {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        body {
            min-width: 1240px;
        }

        li {
            list-style: none;
        }

        img, fieldset {
            border: 0;
            vertical-align: top;
        }

        table {
            table-layout: fixed;
            width: 100%;
            border: 0;
            border-spacing: 0;
            border-collapse: collapse;
        }

        table img {
            vertical-align: middle;
        }

        caption {
            display: none;
        }

        th, td {
            border: 0;
            word-wrap: break-word;
        }

        input, select, textarea, button {
            font-size: 12px;
            font-family: "Noto Sans KR", "맑은 고딕", "malgun gothic", "Apple SD Gothic Neo", sans-serif;
            color: #1b1e26;
            vertical-align: middle;
        }

        html:lang(ko) input, html:lang(ko) select,
        html:lang(ko) textarea, html:lang(ko) button {
            font-size: 13px;
            letter-spacing: -0.5px;
        }

        /* select option 텍스트 안보이는 이슈 */
        html:lang(ko) select {
            text-rendering: optimizeLegibility;
        }

        html:lang(ja) input, html:lang(ja) select, html:lang(ja) textarea, html:lang(ja) button {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) input, html:lang(vi) select, html:lang(vi) textarea, html:lang(vi) button {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) input, html:lang(en) select, html:lang(en) textarea, html:lang(en) button {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        pre {
            font-size: 12px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        html:lang(ko) pre {
            font-size: 13px;
        }

        legend {
            visibility: hidden;
            position: absolute;
            left: -9999px;
            top: -9999px;
            width: 0;
            height: 0;
            line-height: 0;
        }

        button {
            overflow: visible;
            padding: 0;
            margin: 0;
            border: 0;
            cursor: pointer;
            background-color: transparent;
        }

        hr.layout {
            display: none;
        }

        a {
            text-decoration: none;
            color: #1b1e26;
        }

        a:hover {
            text-decoration: underline;
        }

        select:disabled {
            color: #aeb4c6;
            border: solid 1px #d6dae1;
            background-color: #f4f5f8;
        }

        select::-ms-expand {
            display: none;
        }

        input[type=text], textarea {
            outline: 2px solid purple;
        }

        :-ms-input-placeholder {
            color: #aeb4c6;
        }

        ::-moz-placeholder {
            color: #aeb4c6;
        }

        ::-webkit-input-placeholder {
            color: #aeb4c6;
        }

        /* Debug */
        label label,
        label a {
            outline: 2px solid purple;
        }

        [uidev-case], [uidev-mode-display] {
            position: relative;
        }

        [uidev-mode-display="IF"] {
            display: none;
        }

        [uidev-case]:before {
            z-index: 100;
            display: block !important;
            content: "" !important;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(217, 218, 220, 0.6) !important;
        }

        /* 매뉴얼 이미지 버튼 */
        .headingArea .mTitle > a > img {
            border: 2px solid red;
        }

        /* BODY 사이그 reset : 1.9 어드민 프레임 구분시 여백 */
        body.gMargin {
            width: auto;
            min-width: 1016px;
            padding: 24px 24px 50px;
        }

        body.gReset {
            min-width: 0;
        }

        /* 1.9 어드민 고정폭 대응 */
        .gMain {
            margin: 0 0 0 12px;
        }

        body.gMargin .gMain {
            margin-left: 0;
        }

        body.gFixed {
            width: 1028px;
        }

        /* print 새페이지 출력 */
        .printWrap.pageBreak {
            page-break-before: always;
        }

        /* body 폭 리셋 */

        /* Hidden Text */
        .blind {
            overflow: hidden;
            position: absolute;
            width: 0;
            height: 0;
            white-space: nowrap;
            text-indent: 150%;
            font-size: 0;
            line-height: 0;
        }

        /* Grid */
        .section {
            margin: 0 0 24px;
        }

        .section:after {
            content: "";
            display: block;
            clear: both;
        }

        .section.gClearSmartmode { /* smartmode 전용이므로 suio.css에 style을 선언하지 않는다 */
        }

        .section > .gLeft {
            float: left;
            width: 49.5%;
            text-align: left;
        }

        .section > .gRight {
            float: right;
            width: 49.5%;
        }

        .section.fixed {
            max-width: 1028px;
        }

        .mButton.fixed {
            max-width: 1028px;
        }

        .gGrid {
            margin: 10px 0 0;
            padding: 10px 0 0;
            border-top: 1px solid #d9dadc;
        }

        .gSingle {
            display: block;
            margin-top: 5px !important;
        }

        .gDouble {
            display: block;
            margin-top: 10px !important;
        }

        .gTriple {
            display: block;
            margin-top: 15px !important;
        }

        .gBreak {
            display: inline-block;
            margin: 1px 0 0;
        }

        .gSingleBreak {
            display: block;
            margin-bottom: 5px !important;
        }

        .gDoubleBreak {
            display: block;
            margin-bottom: 10px !important;
        }

        .gTripleBreak {
            display: block;
            margin-bottom: 15px !important;
        }

        .gMiniSide {
            margin-left: 4px !important;
        }

        .gSingleSide {
            margin-left: 11px !important;
        }

        .gDoubleSide {
            margin-left: 25px !important;
        }

        .gTripleSide {
            margin-left: 40px !important;
        }

        .gIcon {
            margin-top: 5px;
        }

        .gWidth {
            display: inline-block;
            vertical-align: middle;
            word-wrap: break-word;
        }

        /* gridSet */
        .gridSet {
            display: -webkit-flex;
            display: -ms-flex;
            display: -moz-flex;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            -moz-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .gridSet .grid {
            word-break: break-all;
        }

        .gridSet.nowrap {
            -webkit-flex-wrap: nowrap;
            -ms-flex-wrap: nowrap;
            -moz-flex-wrap: nowrap;
            flex-wrap: nowrap;
        }

        .gridSet .grid.nowrap {
            white-space: nowrap;
        }

        .gridSet .grid.gFlex1 {
            -webkit-flex: 1;
            -ms-flex: 1;
            -moz-flex: 1;
            flex: 1;
        }

        .gridSet .grid.gFlex2 {
            -webkit-flex: 2;
            -ms-flex: 2;
            -moz-flex: 2;
            flex: 2;
        }

        /* parent align */
        .gridSet.top {
            -webkit-align-items: flex-start;
            -ms-align-items: flex-start;
            -moz-align-items: flex-start;
            align-items: flex-start;
        }

        .gridSet.middle {
            -webkit-align-items: center;
            -ms-align-items: center;
            -moz-align-items: center;
            align-items: center;
        }

        .gridSet.bottom {
            -webkit-align-items: flex-end;
            -ms-align-items: flex-end;
            -moz-align-items: flex-end;
            align-items: flex-end;
        }

        .gridSet.left {
            text-align: left;
            -webkit-justify-content: flex-start;
            -ms-justify-content: flex-start;
            justify-content: flex-start;
        }

        .gridSet.center {
            text-align: center;
            -webkit-justify-content: center;
            -ms-justify-content: center;
            justify-content: center;
        }

        .gridSet.right {
            text-align: right;
            -webkit-justify-content: flex-end;
            -ms-justify-content: flex-end;
            justify-content: flex-end;
        }

        /* child align */
        .gridSet .grid.top {
            -webkit-align-self: flex-start;
            -ms-align-self: flex-start;
            -moz-align-self: flex-start;
            align-self: flex-start;
        }

        .gridSet .grid.middle {
            -webkit-align-self: center;
            -ms-align-self: center;
            -moz-align-self: center;
            align-self: center;
        }

        .gridSet .grid.bottom {
            -webkit-align-self: flex-end;
            -ms-align-self: flex-end;
            -moz-align-self: flex-end;
            align-self: flex-end;
        }

        .gridSet .grid.left {
            text-align: left;
        }

        .gridSet .grid.center {
            text-align: center;
        }

        .gridSet .grid.right {
            text-align: right;
        }

        .gridSet.gBetween {
            -webkit-justify-content: space-between;
            -ms-justify-content: space-between;
            -moz-justify-content: space-between;
            justify-content: space-between;
        }

        /* Size : width.css */

        /* gDisplay */
        html:lang(ko) .gDisplaynone_ko_KR {
            display: none;
        }

        html:lang(ko) .gDisplayblock_ko_KR {
            display: block;
        }

        html:lang(ja) .gDisplaynone_ja_JP {
            display: none;
        }

        html:lang(ja) .gDisplayblock_ja_JP {
            display: block;
        }

        html:lang(vi) .gDisplaynone_vi_VN {
            display: none;
        }

        html:lang(vi) .gDisplayblock_vi_VN {
            display: block;
        }

        html:lang(en) .gDisplaynone_en_US {
            display: none;
        }

        html:lang(en) .gDisplayblock_en_US {
            display: block;
        }

        /* Popup */
        #popup {
            position: relative;
            min-width: 400px;
        }

        #popup #wrap {
            padding: 0 15px 60px;
        }

        #popup.bottomSpace #wrap {
            padding-bottom: 260px;
        }

        #popup #footer {
            position: fixed;
            left: 0;
            bottom: 0;
            z-index: 300;
            width: 100%;
            padding: 10px 0;
            text-align: center;
            border-top: 1px solid #d6d6d6;
            background-color: #f5f5f5;
        }

        /* iframe */
        #iframe {
            min-width: 0;
            height: auto;
        }

        #iframe .section:first-child .mTitle {
            margin-top: 0;
        }

        /* ----------------------------------------- Element & Text Module  ----------------------------------------- */

        /* headingArea */
        .headingArea {
            position: relative;
            margin: 0 0 16px;
        }

        .headingArea .mTitle {
            margin-top: 0;
        }

        .headingArea h1 {
            position: relative;
            display: inline-block;
            padding: 0 2px 0 0;
            height: 32px;
            line-height: 32px;
            color: #1b1e26;
            font-size: 20px;
            vertical-align: middle;
        }

        html:lang(ja) .headingArea h1 {
            line-height: 38px;
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .headingArea h1 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .headingArea h1 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        /* headingArea Reset */
        #popup .headingArea {
            padding-top: 0;
        }

        #popup .headingArea .mTitle {
            position: relative;
            padding: 40px 0 0;
            margin: 0 0 16px;
        }

        .headingArea.gMain {
            margin-left: 12px;
        }

        .headingArea.gMain h1 {
            display: inline-block;
        }

        .headingArea .mTitle ol li {
            background: none;
            list-style: none;
        }

        .headingArea .mTitle:after {
            position: absolute;
        }

        /* mTitle */
        .mTitle {
            position: relative;
            margin: 18px 0 8px;
        }

        .mTitle:after {
            content: "";
            display: block;
            clear: both;
            position: absolute;
        }

        .mTitle h2 {
            display: inline-block;
            padding: 0 5px 0 0;
            color: #1b1e26;
            font-size: 16px;
            line-height: 1.5;
            vertical-align: middle;
        }

        html:lang(ja) .mTitle h2 {
            line-height: 22px;
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mTitle h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mTitle h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mTitle h2 img {
            vertical-align: middle;
        }

        .mTitle h2 ~ [class^="btn"] {
            vertical-align: -3px \0;
        }

        .mTitle h3 {
            display: inline-block;
            padding: 0 5px 0 0;
            color: #1b1e26;
            font-size: 12px;
            line-height: 1.5;
            vertical-align: middle;
        }

        html:lang(ko) .mTitle h3 {
            font-size: 13px;
        }

        .mTitle .button {
            display: inline-block;
            vertical-align: middle;
        }

        .mTitle span[class^="ico"] {
            margin: 0 0 0 4px;
        }

        .mTitle > p,
        .mTitle ul {
            margin: 8px 0 0;
            color: #667084;
        }

        .mTitle li, .mTitle > p {
            position: relative;
            padding: 0 0 0 10px;
        }

        .mTitle h2 ~ p:before,
        .mTitle h2 ~ ul li:before,
        .mTitle h3 ~ p:before,
        .mTitle h3 ~ ul li:before {
            background-color: #777;
        }

        .mTitle > ul li:before, .mTitle > p:before {
            content: "";
            position: absolute;
            top: 7px;
            left: 0;
            width: 4px;
            height: 1px;
            background-color: #898989;
        }

        .mTitle .empty {
            padding-left: 0;
        }

        .mTitle .empty:before {
            display: none;
        }

        /* mTitle Reset */
        .mLayer .mTitle {
            margin: 12px 0 8px;
        }

        .mLayer .mTitle h3 {
            padding: 0;
            font-size: 13px;
        }

        html:lang(ja) .mLayer .mTitle h3 {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mLayer .mTitle h3 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mLayer .mTitle h3 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mLayer .mTitle > p,
        .mLayer .mTitle ul {
            margin: 4px 0 8px;
        }

        .mTitle .gRight {
            position: absolute;
            right: 0;
            bottom: 0;
        }

        /* mBreadcrumb */
        /*
      참고 :
        * ECAdmin 일반회원로 등록시, 뉴 버전 레이아웃 사용 인해, 내비게이션 노출안함
        * ECAdmin 공급사로 등록 시, 구 버전 레이아웃을 사용 인해, 내비게이션 노출함
    */
        .mBreadcrumb {
            position: absolute;
            right: 0;
            top: 0;
        }

        .mBreadcrumb ol {
            float: left;
        }

        .mBreadcrumb li {
            position: relative;
            float: left;
            margin: 0 0 0 10px;
            padding: 0 0 0 15px;
            color: #667084;
        }

        .mBreadcrumb li:before {
            content: "";
            position: absolute;
            top: 8px;
            left: 0;
            width: 4px;
            height: 4px;
            border-top: 1px solid #858792;
            border-right: 1px solid #858792;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .mBreadcrumb li a {
            color: #5e7e95;
        }

        .mBreadcrumb li.home {
            margin: 0;
            padding: 0;
        }

        .mBreadcrumb li.home:before {
            display: none;
        }

        .mBreadcrumb li.now {
            font-weight: bold;
            color: #444b59;
        }

        .mBreadcrumb li.now:before {
            border-color: #444b59;
        }

        .mBreadcrumb .manual,
        .mBreadcrumb .help {
            position: relative;
            top: -1px;
            float: left;
            display: inline;
            overflow: hidden;
            width: 55px;
            height: 19px;
            margin-left: 5px;
            white-space: nowrap;
            text-indent: 150%;
        }

        .mBreadcrumb .manual {
            background: url("//img.echosting.cafe24.com/suio/sflex_heading.png") -195px -500px no-repeat;
        }

        .mBreadcrumb .help {
            background: url("//img.echosting.cafe24.com/suio/sflex_heading.png") -95px -600px no-repeat;
        }

        /* mDesc */
        .mDesc {
            margin: 0 0 18px;
        }

        ul.mDesc li,
        p.mDesc {
            position: relative;
            padding: 0 0 0 10px;
            line-height: 1.4;
        }

        ul.mDesc li:before,
        p.mDesc:before {
            content: "";
            position: absolute;
            top: 6px;
            left: 0;
            width: 5px;
            height: 1px;
            background-color: #1c1c1c;
        }

        /* Text */
        .txtNormal, .txtNormal a {
            color: #1c1c1c;
            font-style: normal;
        }

        .txtEm, .txtEm a {
            color: #3971ff;
            font-style: normal;
        }

        .txtWarn, .txtWarn a {
            color: #ef5012;
            font-style: normal;
        }

        .txtStress, .txtStress a {
            color: #00ad33;
            font-style: normal;
        }

        a .txtEm, a:hover .txtEm,
        a .txtWarn, a:hover .txtWarn,
        a .txtStress, a:hover .txtStress,
        a .txtLight, a:hover .txtLight {
            text-decoration: underline;
        }

        .txtEng {
            font-family: verdana, sans-serif;
        }

        .txtKor {
            font-family: "굴림", Gulim, sans-serif;
        }

        .txtCode {
            font-family: 'Oxygen Mono';
        }

        .txtMore {
            font-size: 14px;
        }

        .txtLess {
            font-size: 12px;
            vertical-align: middle;
        }

        html:lang(ko) .txtLess {
            font-size: 13px;
        }

        .txtLight {
            color: #667084;
        }

        .txtMust em {
            font-style: normal;
            color: #ff5a00;
        }

        .txtIcon {
            font-size: 12px;
            font-weight: normal;
        }

        html:lang(ko) .txtIcon {
            font-size: 13px;
        }

        .txtByte {
            color: #667084;
            display: inline-block;
            vertical-align: top;
            margin-top: 4px;
        }

        .txtByte.gBottom {
            vertical-align: bottom;
        }

        .txtByte strong {
            color: #3971ff;
            font-weight: normal;
            vertical-align: bottom;
        }

        p.txtByte {
            margin: 5px 0 0;
        }

        .txtInfo {
            margin: 0 0 0 10px;
            font-size: 11px;
            letter-spacing: 0;
            color: #667084;
            font-style: normal;
            line-height: 16px;
        }

        .txtInfo.txtMore {
            font-size: 12px;
        }

        html:lang(ko) .txtInfo.txtMore {
            font-size: 13px;
        }

        p.txtInfo, ul.txtInfo {
            margin: 8px 0 0 0;
        }

        p.txtInfo {
            position: relative;
            padding: 0 0 0 7px;
        }

        p.txtInfo:before {
            content: "";
            position: absolute;
            top: 8px;
            left: 0;
            width: 4px;
            height: 1px;
            background-color: #898989;
        }

        ul.txtInfo li {
            position: relative;
            margin: 0;
            padding: 0 0 0 7px;
        }

        ul.txtInfo li:before {
            content: "";
            position: absolute;
            top: 8px;
            left: 0;
            width: 4px;
            height: 1px;
            background-color: #898989;
        }

        .txtInfo li.empty {
            padding-left: 0;
        }

        .txtInfo li.empty:before {
            display: none;
        }

        p.txtInfo.txtMore:before, ul.txtInfo.txtMore li:before {
            top: 7px;
            background-color: #1c1c1c;
        }

        .txtDel {
            text-decoration: line-through;
        }

        a.txtLink {
            text-decoration: underline;
        }

        a.txtLink:hover {
            color: #3971ff;
        }

        .txtEllipsis {
            display: inline-block;
            overflow: hidden;
            max-width: 100%;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        ul.txtEllipsis {
            display: block;
        }

        ul.txtEllipsis li {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .txtLaw {
            display: inline-block;
            overflow: hidden;
            height: 14px;
            font-size: 0;
            line-height: 0;
            background: url('//img.echosting.cafe24.com/suio/ko_KR/sfix_icon_guide.png') 0 0 no-repeat;
            vertical-align: middle;
        }

        html:lang(vi) .txtLaw {
            background-image: url('//img.echosting.cafe24.com/suio/vi_VN/sfix_icon_guide.png');
        }

        html:lang(en) .txtLaw {
            background-image: url('//img.echosting.cafe24.com/suio/en_US/sfix_icon_guide.png');
        }

        .txtDesign {
            width: 87px;
            background-position: 0 0;
        }

        .txtLaw {
            width: 56px;
            background-position: 0 -50px;
        }

        html:lang(vi) .txtLaw {
            width: 85px;
        }

        html:lang(en) .txtLaw {
            width: 97px;
        }

        /* 아이콘 : 법적고지 */
        .mTooltip.typeLaw {
            width: 55px;
            height: 14px;
        }

        html:lang(vi) .mTooltip.typeLaw {
            width: 85px;
        }

        html:lang(en) .mTooltip.typeLaw {
            width: 97px;
        }

        .mTooltip.typeLaw .icon {
            background: url('//img.echosting.cafe24.com/ec/v2/sflex_tooltip.png') 0 -314px no-repeat;
        }

        /* Reset */
        .mForm .addForm ul.txtInfo li {
            margin: 0;
        }

        .mForm .addForm.gHor ul.txtInfo li {
            display: block;
        }

        .mBoard .disabled {
            color: #bababa;
        }

        .mBoard .disabled a {
            cursor: text;
            color: #bababa;
            text-decoration: none;
        }

        .mBoard .disabled a.txtLink {
            text-decoration: underline;
        }

        .mBoard .disabled .txtPointer {
            cursor: pointer;
        }

        .mBoard .disabled .txtPointer:hover {
            color: #1b87d4;
        }

        .mBoard .disabled .txtEm {
            color: #b5d7f8;
            text-decoration: none;
        }

        .mBoard .disabled .txtWarn {
            color: #f9b9a0;
            text-decoration: none;
        }

        .mBoard .disabled .mList,
        .mBoard .disabled .mList li,
        .mBoard .disabled .txtInfo,
        .mBoard .disabled .txtInfo li,
        .mBoard .disabled .gGoods .etc {
            color: #bababa;
        }

        .mBoard .disabled p.mList:before,
        .mBoard .disabled ul.mList > li:before,
        .mBoard .disabled p.txtInfo:before,
        .mBoard .disabled ul.txtInfo > li:before {
            background-color: #bababa;
        }

        .mBoard .disabled .gGoods .open a {
            color: #1c1c1c;
        }

        .mBoard.typeBody tr.hide td {
            padding: 0;
            border: 0;
        }

        .mBoard.typeBody tr.hide td > div {
            display: none;
        }

        span.txtNotice,
        p.txtNotice,
        ul.txtNotice li {
            padding: 4px 0 4px 23px;
            font-size: 12px;
            line-height: 18px;
            background: url('//img.echosting.cafe24.com/suio/sfix_text.png') no-repeat 3px 7px;
        }

        html:lang(ko) p.txtNotice,
        html:lang(ko) ul.txtNotice li {
            font-size: 13px;
        }

        span.txtNotice {
            margin: 0 0 0 4px;
            padding: 4px 0 0 20px;
            background-position: 3px 4px;
        }

        .txtNotice li.txtEm {
            color: #0090ec;
        }

        .txtNotice li.txtWarn {
            color: #ef5012;
        }

        /* Image&Frame */
        .trans {
            background: url('//img.echosting.cafe24.com/suio/bg_transparent.gif');
        }

        .frame img {
            max-width: 670px;
            padding: 2px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        .figure img {
            max-width: 670px;
            border: 1px solid #ccc;
        }

        span.zoom img {
            border: 1px solid #ccc;
        }

        span.zoom .btnZoom {
            overflow: hidden;
            position: absolute;
            right: 0;
            bottom: 0;
            width: 20px;
            height: 19px;
            font-size: 0;
            line-height: 0;
            text-indent: 150%;
            cursor: pointer;
            background: url("//img.echosting.cafe24.com/suio/btn_figure_closeup.gif") no-repeat 0 0;
        }

        .auto img {
            max-width: none;
        }

        .frame, .figure, span.zoom {
            display: inline-block;
            position: relative;
        }

        .frame .icoDelete, .figure .icoDelete, span.zoom .icoDelete {
            display: none;
            position: absolute;
            top: 0;
            right: 0;
            width: 20px;
            height: 20px;
        }

        .frame:hover .icoDelete, .figure:hover .icoDelete, span.zoom:hover .icoDelete {
            display: block;
        }

        /* Form */
        input[type="checkbox"] {
            position: relative;
            opacity: 1;
            width: 14px;
            height: 14px;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('//img.echosting.cafe24.com/ec/v2/sfix_icon_form.png');
            background-position: 0 0;
            background-repeat: no-repeat;
            outline: 0;
        }

        input[type="checkbox"]:checked {
            background-position: -50px 0;
        }

        input[type="checkbox"]:disabled {
            background-position: -150px 0;
        }

        input[type="radio"] {
            position: relative;
            opacity: 1;
            width: 14px;
            height: 14px;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('//img.echosting.cafe24.com/ec/v2/sfix_icon_form.png');
            background-position: 0 -50px;
            background-repeat: no-repeat;
            outline: 0;
        }

        input[type="radio"]:checked {
            background-position: -50px -50px;
        }

        input[type="radio"]:disabled {
            background-position: -150px -50px;
        }

        input[type="checkbox"]:checked:disabled {
            background-position: -150px 0;
        }

        input[type="radio"]:checked:disabled {
            background-position: -150px -50px;
        }

        label.gLabel {
            display: inline-block;
            padding: 0 24px 0 0;
            outline: 0 none;
        }

        label.gSingleLabel {
            display: inline-block;
            padding: 0 8px 0 0;
            outline: 0 none;
        }

        span.gLabel, .fSelect.gLabel, .fText.gLabel {
            margin: 0 24px 0 -18px;
            zoom: 1;
        }

        span.gSingleLabel, .fSelect.gSingleLabel, .fText.gSingleLabel {
            margin: 0 15px 0 -15px;
            zoom: 1;
        }

        label.eSelected {
            font-weight: bold;
        }

        label .fChk {
            vertical-align: sub;
        }

        .fChk {
            display: inline-block;
            width: 14px;
            height: 14px;
            outline: none;
            background-image: url('//img.echosting.cafe24.com/ec/v2/sfix_icon_form.png');
            background-repeat: no-repeat;
            -webkit-appearance: none;
            appearance: none;
        }

        /* checkbox */
        .fChk[type="checkbox"] {
            background-position: 0 0;
        }

        /* selected */
        label .fChk[type="checkbox"]:checked,
        label.eSelected .fChk[type="checkbox"]:checked {
            background-position: -50px 0;
        }

        /* disabled */
        label .fChk[type="checkbox"]:disabled {
            background-position: -100px 0;
        }

        /* checked & disabled */
        label .fChk[type="checkbox"]:checked:disabled,
        label.eSelected .fChk[type="checkbox"]:checked.disabled {
            background-position: -150px 0;
        }

        /*table in checkbox*/
        table input[type="checkbox"],
        table .allChk[type="checkbox"],
        table .rowChk[type="checkbox"] {
            display: inline-block;
            width: 14px;
            height: 14px;
            outline: none;
            background-image: url('//img.echosting.cafe24.com/ec/v2/sfix_icon_form.png');
            background-repeat: no-repeat;
            -webkit-appearance: none;
            appearance: none;
        }

        /* selected */
        table input[type="checkbox"]:checked,
        table .selected input[type="checkbox"]:checked,
        table .allChk[type="checkbox"]:checked,
        table .selected .allChk[type="checkbox"]:checked,
        table .rowChk[type="checkbox"]:checked,
        table .selected .rowChk[type="checkbox"]:checked {
            background-position: -50px 0;
        }

        /* disabled */
        table input[type="checkbox"]:disabled,
        table .allChk[type="checkbox"]:disabled,
        table .rowChk[type="checkbox"]:disabled,
        table .disabled input[type="checkbox"] {
            background-position: -100px 0;
        }

        /* checked & disabled */
        table .selected input[type="checkbox"]:checked:disabled,
        table .disabled input[type="checkbox"]:checked,
        table .selected .allChk[type="checkbox"]:checked:disabled,
        table .disabled .allChk[type="checkbox"]:checked,
        table .selected .rowChk[type="checkbox"]:checked:disabled,
        table .disabled .rowChk[type="checkbox"]:checked {
            background-position: -150px 0;
        }

        /* radio */
        .fChk[type="radio"] {
            background-position: 0 -50px;
        }

        /* selected */
        table .fChk[type="radio"]:checked,
        label .fChk[type="radio"]:checked,
        label.eSelected .fChk[type="radio"]:checked {
            background-position: -50px -50px;
        }

        /* disabled */
        table .fChk[type="radio"]:disabled,
        label .fChk[type="radio"]:disabled,
        label .fChk[type="radio"].disabled {
            background-position: -100px -50px;
        }

        /* checked & disabled */
        label.eSelected .fChk[type="radio"]:checked:disabled,
        label.eSelected .fChk[type="radio"]:checked.disabled {
            background-position: -150px -50px;
        }

        span.fChk {
            display: inline-block;
        }

        input.fText {
            max-width: 100%;
            height: 28px;
            padding: 0 8px;
            border: 1px solid #d6dae1;
            border-radius: 3px;
            box-sizing: border-box;
            line-height: 28px;
            outline: 0 none;
        }

        input.fText:disabled,
        input.fText.disabled {
            background-color: #f4f5f8;
        }

        /* fReset */
        .fReset {
            display: inline-block;
            position: relative;
            vertical-align: top;
        }

        .fReset .fText {
            vertical-align: top;
        }

        .fReset .btnReset {
            position: absolute;
            top: 3px;
            right: 0;
            overflow: hidden;
            width: 0;
            font-size: 1px;
            line-height: 0;
            color: transparent;
            text-indent: -150%;
            white-space: nowrap;
        }

        .fReset.selected .fText {
            padding: 0 20px 0 5px;
        }

        .fReset.selected .btnReset {
            display: block;
            width: 20px;
            height: 22px;
        }

        .fReset.selected .btnReset:before {
            content: "";
            position: absolute;
            top: 6px;
            right: 5px;
            width: 11px;
            height: 10px;
            background: url("//img.echosting.cafe24.com/ec/v2/ko_KR/sfix_icon_button2.png") no-repeat -100px -800px;
        }

        input.fText.gDate {
            width: 90px;
        }

        .fText:focus {
            border-color: #3971ff;
            background-color: #f7f7f7;
        }

        .fText.center {
            text-align: center;
        }

        .fText.right {
            text-align: right;
        }

        .fKorean {
            ime-mode: active;
        }

        /* 웹킷브라우저 미지원 */
        .fText.uppercase {
            text-transform: uppercase;
        }

        .fTextarea {
            max-width: 100%;
            box-sizing: border-box;
            padding: 5px;
            border: 1px solid #a7a7a7;
            border-right-color: #cfcfcf;
            border-bottom-color: #cfcfcf;
            font-size: 12px;
            line-height: 140%;
            outline: 0 none;
        }

        html:lang(ko) .fTextarea {
            font-size: 13px;
        }

        .fTextarea:focus {
            border-color: #3971ff;
            background-color: #f7f7f7;
        }

        .fFile {
            height: 23px;
            font-size: 12px;
        }

        html:lang(ko) .fFile {
            font-size: 13px;
        }

        .fSelect {
            display: inline;
            height: 28px;
            margin: 0;
            padding: 0 24px 0 8px;
            border-radius: 3px;
            border: 1px solid #d6dae1;
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
            background: #fff url('//img.echosting.cafe24.com/ec/v2/ico_select.png') no-repeat right 7px center;
        }

        /* disabled */
        .fText.disabled,
        .fTextarea.disabled {
            background-color: #ebebe4;
        }

        .fText.disabled:focus,
        .fTextarea.disabled:focus {
            border: 1px solid #a7a7a7;
            border-right-color: #cfcfcf;
            border-bottom-color: #cfcfcf;
        }

        /* category width */
        .fSelect.category {
            width: 125px;
        }

        html:lang(ja) .fSelect.category {
            width: 139px;
        }

        html:lang(vi) .fSelect.category {
            width: 175px;
        }

        html:lang(en) .fSelect.category {
            width: 130px;
        }

        .fSelect.full {
            width: 100%;
        }

        .fMultiple {
            border: 1px solid #cacaca;
        }

        .fMultiple option {
            padding: 3px 0;
        }

        /* input[type="number"] */
        .gNumber {
            overflow: hidden;
            display: inline-block;
            position: relative;
            padding: 0 17px 0 0;
            border: 1px solid #d6dae1;
            border-radius: 3px;
            font-size: 0;
            line-height: 0;
            vertical-align: middle;
            background-color: #fff;
        }

        .gNumber input.fText {
            float: left;
            width: 60px;
            padding: 0 5px 0 0;
            border: 0;
            border-right: 1px solid #d6dae1;
            border-radius: 0;
            font-size: 12px;
            text-align: right;
        }

        html:lang(ko) .gNumber input.fText {
            font-size: 13px;
        }

        .gNumber button {
            position: absolute;
            right: 0;
            width: 17px;
            font-size: 0;
            line-height: 0;
            background-color: #fff;
        }

        .gNumber button:hover {
            background-color: #f4f5f8;
        }

        .gNumber button span {
            position: absolute;
            left: 5px;
            overflow: hidden;
            width: 0;
            height: 0;
            white-space: nowrap;
            text-indent: 150%;
            border-width: 3.5px;
            border-style: solid;
            border-color: #aeb4c6 transparent transparent transparent;
            vertical-align: middle;
            transform: rotate(-180deg);
            -webkit-transform: rotate(-180deg);
        }

        .gNumber button.up {
            top: 0;
            height: 14px;
        }

        .gNumber button.up span {
            top: 1px;
        }

        .gNumber button.down {
            bottom: 0;
            height: 15px;
            border-top: 1px solid #d6dae1;
        }

        .gNumber button.down span {
            top: 6px;
            transform: rotate(0);
            -webkit-transform: rotate(0);
        }

        /* Form Reset */
        .mLayer label.gLabel,
        .mOption label.gLabel {
            padding-right: 20px;
        }

        .mLayer .mTooltip.gLabel {
            margin: 0 20px 0 -15px;
        }

        .mLayer span.gLabel,
        .mLayer .fSelect.gLabel,
        .mLayer .fText.gLabel,
        .mOption span.gLabel,
        .mOption .fSelect.gLabel,
        .mOption .fText.gLabel {
            margin: 0 10px 0 -15px;
        }

        .mSearchSelect label.gLabel {
            padding-right: 5px;
        }

        .mSearchSelect .list label.gLabel {
            padding-right: 0;
        }

        ::-webkit-file-upload-button {
            cursor: pointer;
        }

        .gFile {
            position: relative;
            display: inline-block;
            overflow: hidden;
            vertical-align: middle;
        }

        .gFile .file {
            z-index: 1;
            position: absolute;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .btnFile {
            display: inline-block;
            padding: 0 0 0 14px;
            vertical-align: middle;
            background: url('//img.echosting.cafe24.com/suio/bg_btn_file.gif') no-repeat 0 3px;
        }

        .btnFile:hover {
            color: #1b87d4;
        }

        .gForm {
            display: inline;
        }

        .fToggle {
            display: inline-block;
            overflow: hidden;
            position: relative;
            width: 50px;
            height: 20px;
            border-radius: 20px;
            vertical-align: top;
        }

        .fToggle .check {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
        }

        .fToggle .check + .label {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            cursor: pointer;
            background-color: #838c9e;
        }

        .fToggle .check + .label:before {
            content: "";
            position: absolute;
            bottom: 1px;
            left: 1px;
            width: 18px;
            height: 18px;
            border-radius: 18px;
            background-color: #fff;
            -webkit-transition: transform .4s;
            transition: transform .4s;
        }

        .fToggle .check:checked + .label {
            background-color: #1b87d4;
        }

        .fToggle .check:checked + .label:before {
            -webkit-transform: translateX(30px);
            -ms-transform: translateX(30px);
            transform: translateX(30px);
        }

        .fToggle .check + .label:after {
            content: "OFF";
            position: absolute;
            top: 0;
            left: 21px;
            bottom: 0;
            z-index: -1;
            color: #dadde2;
            font-size: 11px;
            letter-spacing: 0;
            font-weight: 300;
            line-height: 22px;
            letter-spacing: 0;
            text-align: center;
            box-sizing: border-box;
        }

        .fToggle .check:checked + .label:after {
            content: "ON";
            left: 0;
            right: 15px;
        }

        /* mForm */
        ul.mForm {
            margin: -8px 0 0;
        }

        div.mForm {
            margin: 2px 0 0;
        }

        .mForm li {
            margin: 8px 0 0;
        }

        .mForm .addForm {
            margin: 8px 0 0 25px;
        }

        .mForm ul.addForm {
            margin-top: 0;
        }

        .mForm .addForm .subform {
            margin: 4px 0 0 18px;
        }

        .mForm .addForm .subform li {
            margin-top: 4px;
        }

        .mForm.gVer {
        }

        ul.mForm.gIndent {
            margin-top: -5px;
            margin-left: 20px;
        }

        .mForm.gIndent {
            margin-left: 20px;
        }

        .mForm.typeHor {
            position: relative;
        }

        .mForm.typeHor li {
            display: inline-block;
        }

        .mForm.typeHor li.block {
            display: block;
            padding: 0;
        }

        .mForm.typeHor.gTop li .fChk {
            vertical-align: top;
        }

        .addForm {
            display: none;
        }

        .addForm.show {
            display: block;
        }

        .addForm > li {
            margin-top: 8px;
        }

        .addForm.gVer {
        }

        .addForm.gHor li {
            display: inline-block;
        }

        .addForm.gHor li.block {
            display: block;
            padding: 0;
        }

        .fSelect + ul.mForm {
            margin: 0;
        }

        /* mForm Reset */
        .mBox + ul.mForm {
            margin-top: 0;
        }

        /* imageSort */
        .eImgSort:after {
            content: '';
            display: block;
            clear: both;
        }

        .eImgSort li {
            float: left;
            cursor: pointer;
        }

        .eImgSort label {
            cursor: pointer;
        }

        .eImgSort .highlight {
            position: relative;
        }

        .eImgSort .highlight:before {
            content: '';
            position: absolute;
            background-image: url('//img.echosting.cafe24.com/ec/product/sfix_drag.png');
        }

        .eImgSort .ui-sortable-helper {
            position: relative;
            cursor: move;
        }

        .eImgSort .ui-sortable-helper:before {
            content: '';
            position: absolute;
            top: 50%;
            left: -20px;
            width: 20px;
            height: 19px;
            background: url('//img.echosting.cafe24.com/ec/product/sfix_drag.png') -130px 0;
        }

        .eImgSort .ui-sortable-helper:hover .icoDelete {
            display: none;
        }

        .typeVer .eImgSort li {
            float: none;
        }

        /* Placeholder */
        .ePlaceholder {
            display: inline-block;
            position: relative;
            padding: 0 !important;
            vertical-align: middle;
        }

        .ePlaceholder span {
            display: inline-block;
            font-size: 12px;
            color: #b8b8b8;
            vertical-align: middle;
            position: absolute;
            top: 0;
            left: 0;
            margin: 4px 0 0 6px;
            cursor: text;
        }

        html:lang(ko) .ePlaceholder span {
            font-size: 13px;
        }

        .ePlaceholder.typeFull {
            display: block;
        }

        .ePlaceholder.typeFull span {
            padding: 0 50px 0 0;
        }

        .ePlaceholder.typeFull input {
            width: 98%;
        }

        /* mButton */
        .mButton {
            margin: 16px 0 0;
            text-align: right;
        }

        .mButton:after {
            content: "";
            display: block;
            clear: both;
        }

        .mButton a {
            margin: 0 0 0 8px;
        }

        .mButton a:first-child {
            margin-left: 0;
        }

        .mButton .gLeft {
            float: left;
            text-align: left;
        }

        .mButton .gLeft a {
            margin: 0 10px 0 0;
        }

        .mButton .gRight {
            float: right;
        }

        .mButton .gRight a {
            margin: 0 0 0 10px;
        }

        .mButton.gCenter {
            position: relative;
            text-align: center;
        }

        .mButton.gCenter .gLeft {
            position: absolute;
            left: 0;
        }

        .mButton.gCenter .gRight {
            position: absolute;
            right: 4px;
        }

        .mButton .gInfo {
            float: left;
            line-height: 18px;
            text-align: left;
        }

        .mButton .cTip {
            margin: 0 0 0 8px;
        }

        .mButton .txtLink {
            font-size: 12px;
            color: #898989;
        }

        html:lang(ko) .mButton .txtLink {
            font-size: 13px;
        }

        /* mButton Reset */
        .mLayer .wrap .mButton:first-child {
            margin: 0 0 5px 0;
        }

        /* 기본 시스템 버튼 */
        .btnNormal, .btnNormal span,
        .btnCtrl, .btnCtrl span,
        .btnDate, .btnDate span,
        .btnGeneral, .btnGeneral span,
        .btnStrong, .btnStrong span,
        .btnSubmit, .btnSubmit span,
        .btnEm, .btnEm span,
        .btnSearch, .btnSearch span,
        .btnToggle {
            display: inline-block;
            position: relative;
            text-align: center;
            vertical-align: middle;
            text-decoration: none;
            white-space: nowrap;
            box-sizing: border-box;
            border-radius: 3px;
        }

        .btnNormal span, .btnCtrl span, .btnDate span, .btnGeneral span, .btnStrong span, .btnSubmit span, .btnEm span, .btnSearch span {
            vertical-align: top;
        }

        /* 공통 */
        [class^="btn"], [class^="btn"] span {
            cursor: pointer;
        }

        [class^="btn"].disabled, [class^="btn"].disabled span {
            cursor: default;
        }

        [class^="btn"].vTop {
            vertical-align: top;
        }

        /* btnNormal */
        .btnNormal, .btnNormal span {
            height: 28px;
        }

        .btnNormal span {
            padding: 0 8px;
            border: 1px solid #aeb4c6;
            font-size: 12px;
            line-height: 26px;
            color: #1b1e26;
            font-weight: normal;
            background-color: #fff;
        }

        html:lang(ko) .btnNormal span {
            font-size: 13px;
        }

        .btnNormal:hover span,
        .btnNormal.selected span {
            background-color: #f4f9ff;
        }

        .btnNormal:disabled span,
        .btnNormal.disabled span,
        .btnNormal:disabled:hover span,
        .btnNormal.disabled:hover span {
            border-color: #d6dae1;
            color: #aeb4c6;
            background-color: #fafafd;
        }

        /* Font Reset */
        .txtMore + .btnNormal {
            margin-top: -2px;
        }

        /* mLayer Reset */
        .mLayer .footer .btnNormal span {
            padding: 0 12px;
        }

        /* btnCtrl */
        .btnCtrl, .btnCtrl span {
            height: 28px;
        }

        .btnCtrl span {
            padding: 0 8px;
            border: 1px solid transparent;
            font-size: 12px;
            line-height: 26px;
            color: #fff;
            font-weight: normal;
            background-color: #444b59;
        }

        html:lang(ko) .btnCtrl span {
            font-size: 13px;
        }

        .btnCtrl:hover span,
        .btnCtrl.selected span {
            background-color: #667084;
        }

        .btnCtrl:disabled span,
        .btnCtrl.disabled span,
        .btnCtrl:disabled:hover span,
        .btnCtrl.disabled:hover span {
            background-color: #d6dae1;
        }

        /* mLayer Reset */
        .mLayer .footer .btnCtrl span {
            padding: 0 12px;
        }

        /* btnDate */
        .btnDate, .btnDate span {
            height: 28px;
        }

        .btnDate span {
            min-width: 45px;
            padding: 0 8px;
            border: 1px solid #aeb4c6;
            color: #1b1e26;
            font-size: 12px;
            line-height: 26px;
            background-color: #fff;
        }

        html:lang(ko) .btnDate span {
            font-size: 13px;
        }

        .btnDate:hover span,
        .btnDate.selected span {
            border-color: #3971ff;
            z-index: 1;
            color: #3971ff;
        }

        .btnDate.disabled {
            opacity: 0.7;
            filter: alpha(opacity=70);
        }

        .btnDate.disabled span {
            opacity: 0.5;
            filter: alpha(opacity=50);
        }

        .btnDate.disabled:hover span {
            color: #1c1c1c;
            border-color: #cacaca;
            background-color: #f8f8f8;
        }

        /* btnGeneral */
        .btnGeneral, .btnGeneral span {
            height: 36px;
        }

        .btnGeneral span {
            min-width: 72px;
            padding: 0 16px;
            border: 1px solid #3971ff;
            font-size: 13px;
            line-height: 34px;
            color: #3971ff;
            background-color: #fff;
        }

        html:lang(ja) .btnGeneral span {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .btnGeneral span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .btnGeneral span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .btnGeneral:hover span,
        .btnGeneral.selected span {
            border-color: #2952b8;
            color: #2952b8;
        }

        .btnGeneral:disabled span,
        .btnGeneral.disabled span,
        .btnGeneral:disabled:hover span,
        .btnGeneral.disabled:hover span {
            border-color: #aeb4c6;
            color: #aeb4c6;
            background-color: #fafafd;
        }

        /* btnGeneral Reset */
        #popup .btnGeneral, #popup .btnGeneral span {
            height: 30px;
        }

        #popup .btnGeneral span {
            font-size: 12px;
            line-height: 28px;
        }

        html:lang(ko) #popup .btnGeneral span {
            font-size: 13px;
        }

        /* btnStrong */
        .btnStrong, .btnStrong span {
            height: 36px;
        }

        .btnStrong span {
            min-width: 72px;
            padding: 0 16px;
            border: 1px solid transparent;
            font-size: 13px;
            line-height: 34px;
            color: #fff;
            background-color: #3971ff;
        }

        html:lang(ja) .btnStrong span {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .btnStrong span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .btnStrong span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .btnStrong:hover span,
        .btnStrong.selected span {
            background-color: #2952b8;
        }

        .btnStrong:disabled span,
        .btnStrong.disabled span,
        .btnStrong:disabled:hover span,
        .btnStrong.disabled:hover span {
            background-color: #d6dae1;
        }

        /* btnStrong Reset */
        #popup .btnStrong, #popup .btnStrong span {
            height: 30px;
        }

        #popup .btnStrong span {
            font-size: 12px;
            line-height: 28px;
        }

        html:lang(ko) #popup .btnStrong span {
            font-size: 13px;
        }

        /* btnSubmit */
        .btnSubmit, .btnSubmit span {
            height: 40px;
        }

        .btnSubmit span {
            min-width: 102px;
            padding: 0 16px;
            border: 1px solid transparent;
            font-size: 14px;
            color: #fff;
            line-height: 38px;
            background-color: #3971ff;
        }

        html:lang(ja) .btnSubmit span {
            font-weight: normal;
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .btnSubmit span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .btnSubmit span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .btnSubmit:hover span,
        .btnSubmit.selected span {
            background-color: #2952b8;
        }

        .btnSubmit:disabled span,
        .btnSubmit.disabled span,
        .btnSubmit:disabled:hover span,
        .btnSubmit.disabled:hover span {
            background-color: #d6dae1;
        }

        /* btnSubmit Reset */
        #popup .btnSubmit, #popup .btnSubmit span {
            height: 36px;
        }

        #popup .btnSubmit span {
            min-width: 72px;
            padding: 0 16px;
            font-size: 13px;
            line-height: 34px;
        }

        .mBox .btnSubmit, .mBox .btnSubmit span {
            height: 36px;
        }

        .mBox .btnSubmit span {
            min-width: 72px;
            padding: 0 16px;
            font-size: 13px;
            line-height: 34px;
        }

        /* btnLink */
        .btnLink {
            display: inline-block;
            font-size: 12px;
            color: #667084;
        }

        html:lang(ko) .btnLink {
            font-size: 13px;
        }

        .btnLink:hover {
            text-decoration: underline;
        }

        .btnLink.disabled,
        .btnLink.disabled:hover {
            color: #aeb4c6;
        }

        /* btnEm */
        .btnEm, .btnEm span {
            height: 40px;
        }

        .btnEm span {
            min-width: 102px;
            padding: 0 16px;
            border: 1px solid #3971ff;
            font-size: 14px;
            line-height: 38px;
            color: #3971ff;
            background-color: #fff;
        }

        html:lang(ja) .btnEm span {
            font-weight: normal;
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .btnEm span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .btnEm span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .btnEm:hover span,
        .btnEm.selected span {
            border-color: #2952b8;
            color: #2952b8;
        }

        .btnEm:disabled span,
        .btnEm.disabled span,
        .btnEm:disabled:hover span,
        .btnEm.disabled:hover span {
            border-color: #d6dae1;
            color: #aeb4c6;
            background-color: #fafafd;
        }

        /* btnEm Reset */
        #popup .btnEm, #popup .btnEm span {
            height: 36px;
        }

        #popup .btnEm span {
            min-width: 72px;
            padding: 0 16px;
            font-size: 13px;
            line-height: 34px;
        }

        /* btnBubble */
        .btnBubble::-moz-focus-inner {
            padding: 0;
            border: 0;
        }

        .btnBubble {
            height: 23px;
            margin: 3px 0 0 0;
            padding: 0 4px 0 6px;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 21px;
            border: 1px solid #b6dcff;
            border-radius: 3px;
            background: #e5f3ff;
        }

        .btnBubble span {
            display: inline-block;
            height: 21px;
            line-height: 21px;
        }

        .btnBubble:hover,
        button.btnBubble.selected {
            border: 1px solid #4395de;
            background-color: #b7d7f5;
        }

        .btnBubble em.icoDel {
            overflow: hidden;
            display: inline-block;
            width: 14px;
            height: 12px;
            vertical-align: middle;
            white-space: nowrap;
            text-indent: 150%;
            background: url("//img.echosting.cafe24.com/ec/product/sfix_btn.png") -133px -85px no-repeat;
        }

        /* btnToggle */
        .btnToggle {
            height: 22px;
            padding: 0 8px;
            font-size: 12px;
            font-weight: normal;
            color: #a1a1a1;
            line-height: 22px;
            border: 1px solid #cacaca;
            background-color: #fff;
        }

        html:lang(ko) .btnToggle {
            font-size: 13px;
        }

        button.btnToggle.selected {
            color: #fff;
            border-color: transparent;
            background-color: #1b87d4;
        }

        .btnToggle + .btnToggle {
            margin-left: -1px;
        }

        /* btnSorting */
        .gSorting {
            display: inline-block;
            font-size: 0;
            line-height: 0;
            vertical-align: middle;
        }

        .btnSorting {
            display: inline-block;
            width: 22px;
            height: 22px;
            vertical-align: top;
            background: url("//img.echosting.cafe24.com/suio/sfix_sorting2.png") no-repeat;
        }

        .btnSorting span {
            display: block;
            width: 100%;
            height: 100%;
        }

        .btnSorting.thumb {
            background-position: 0 -50px;
        }

        .btnSorting.thumb.selected {
            background-position: 0 0;
        }

        .btnSorting.list {
            background-position: -22px 0;
        }

        .btnSorting.list.selected {
            background-position: -22px -50px;
        }

        /* btnStatus */
        .btnStatus {
            display: inline-block;
            height: 18px;
            padding: 0 6px;
            border-radius: 25px;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 19px;
            color: #fff;
            font-weight: normal;
            text-decoration: none;
            background-color: #e56b4b;
        }

        .btnStatus:hover {
            text-decoration: none;
        }

        /* mFixNav */
        .mFixNav {
            padding: 0 0 5px;
            top: 15px;
            background: url("//img.echosting.cafe24.com/suio/bg_fixnav.png") repeat-x 0 bottom;
        }

        .mFixNav.fixed {
            z-index: 300;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        .mFixNav .nav {
            display: table;
            table-layout: fixed;
            width: 100%;
            border-bottom: 3px solid #85868a;
            border-right: 1px solid #c4c4c4;
            background-color: #f5f5f5;
            box-sizing: border-box;
        }

        .mFixNav .nav li {
            display: table-cell;
            vertical-align: middle;
            border-left: 1px solid #c4c4c4;
        }

        .mFixNav .nav a {
            overflow: hidden;
            display: inline-block;
            width: 100%;
            height: 43px;
            line-height: 43px;
            color: #7f7f7f;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            text-overflow: ellipsis;
            border-left: 1px solid #fcfcfc;
            background-color: #f5f5f5;
            box-sizing: border-box;
        }

        .mFixNav .nav a:hover {
            text-decoration: none;
            color: #000;
        }

        .mFixNav .nav li.br a {
            padding: 6px 0 0 1px;
            line-height: 1.25;
        }

        .mFixNav .nav li.selected {
            z-index: 1;
            position: relative;
        }

        .mFixNav .nav li.selected a {
            text-decoration: none;
            font-weight: bold;
            color: #fff;
            border-color: #8c9093;
            border-right: 1px solid #8c9093;
            letter-spacing: -1px;
            background: #8c9093 url("//img.echosting.cafe24.com/suio/bg_fixnav_selected.gif") repeat-x 0 0;
        }

        /* btnSearch */
        .btnSearch::-moz-focus-inner {
            padding: 0;
            border: 0;
        }

        .btnSearch, .btnSearch span {
            height: 28px;
        }

        .btnSearch span {
            padding: 0 8px;
            border: 1px solid transparent;
            font-size: 12px;
            line-height: 26px;
            color: #fff;
            background-color: #444b59;
        }

        html:lang(ko) .btnSearch span {
            font-size: 13px;
        }

        .btnSearch:hover span,
        .btnSearch.selected span {
            background-color: #667084;
        }

        .btnSearch:disabled span,
        .btnSearch.disabled span,
        .btnSearch:disabled:hover span,
        .btnSearch.disabled:hover span {
            background-color: #d6dae1;
        }

        /* size large*/
        .section > .mButton .btnSearch,
        .section > .mButton .btnSearch span,
        .section > form > .mButton .btnSearch,
        .section > form > .mButton .btnSearch span,
        .optionArea > .mButton .btnSearch,
        .optionArea > .mButton .btnSearch span,
        .optionArea > .optionWrap > .mButton .btnSearch,
        .optionArea > .optionWrap > .mButton .btnSearch span {
            height: 36px;
        }

        .section > .mButton .btnSearch span,
        .section > form > .mButton .btnSearch span,
        .optionArea > .mButton .btnSearch span,
        .optionArea > .optionWrap > .mButton .btnSearch span {
            min-width: 72px;
            font-size: 13px;
            line-height: 34px;
        }

        /* btnSearch + reset */
        .btnSearch.reset span {
            border: 1px solid #aeb4c6;
            color: #1b1e26;
            background-color: #fff;
        }

        .btnSearch.reset:hover span,
        .btnSearch.reset.selected span {
            background-color: #f4f9ff;
        }

        .btnSearch.reset:disabled span,
        .btnSearch.reset.disabled span,
        .btnSearch.reset:disabled:hover span,
        .btnSearch.reset.disabled:hover span {
            border-color: #aeb4c6;
            color: #aeb4c6;
            background-color: #fafafd;
        }

        /* !!!
    .icoUser { width:48px; background-position:0 -338px; }
    .icoUser.selected { background-position:-58px -338px; }
    .icoAdmin { width:48px; background-position:0 -364px; }
    .icoAdmin.selected { background-position:-58px -364px; }
        /* icoUser Reset
        .mBoard .icoUser, .mBoard .icoAdmin { margin-top:0; }
    */

        /* 아이콘 게시판 안내형 */
        .icoStatus {
            display: inline-block;
            width: 10px;
            height: 10px;
            vertical-align: middle;
            margin-top: -2px;
            border: 1px solid #fff;
            border-radius: 2px;
        }

        .icoStatus.negative {
            background: #feeef0;
            border-color: #e19552;
        }

        .icoStatus.positive {
            background: #fff5d8;
            border-color: #d1ca00;
        }

        .icoStatus.div {
            background: #f3fcf2;
            border-color: #b0d0ad;
        }

        /* gCount */
        .gCount {
            position: relative;
            display: inline-block;
        }

        .gCount:after {
            content: attr(data-count-badge);
            display: inline-block;
            overflow: hidden;
            z-index: 5;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            border-radius: 18px;
            box-sizing: border-box;
            background-color: #ec5d4a;
            font-size: 11px;
            letter-spacing: 0;
            color: #fff;
            text-align: center;
            line-height: 18px;
        }

        .gCount.icon:after {
            position: absolute;
            left: 9px;
            top: -9px;
        }

        .gCount.text:after {
            margin: -1px 0 0 3px;
            vertical-align: middle;
        }

        /* mList */
        span.mList {
            margin: 0;
            color: #667084;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 1.5;
        }

        span.mList.txtMore {
            font-size: 12px;
        }

        html:lang(ko) span.mList.txtMore {
            font-size: 13px;
        }

        .mList li {
            background: none;
        }

        p.mList {
            position: relative;
            margin: 8px 0 0;
            padding: 0 0 0 7px;
            color: #667084;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 1.5;
        }

        p.mList:before {
            content: "";
            position: absolute;
            top: 8px;
            left: 0;
            width: 4px;
            height: 1px;
            background-color: #667084;
        }

        ul.mList {
            margin: 8px 0 0;
        }

        ul.mList li {
            position: relative;
            margin: 0;
            padding: 0 0 0 7px;
            color: #667084;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 1.5;
            text-align: left;
        }

        ul.mList li:before {
            content: "";
            position: absolute;
            top: 8px;
            left: 0;
            width: 4px;
            height: 1px;
            background-color: #667084;
        }

        ul.mList > li > ul > li:before {
            width: 2px;
            height: 2px;
        }

        ol.mList {
            margin: 8px 0 0 15px;
        }

        ol.mList li {
            list-style: decimal;
            color: #667084;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 1.5;
        }

        ol.mList li li {
            list-style: none;
        }

        ul.mList > li > ol > li {
            padding: 0;
            list-style: decimal;
        }

        ul.mList > li > ol > li:before {
            display: none;
        }

        p.mList.empty,
        .mList li.empty {
            padding-left: 0;
        }

        p.mList.empty:before,
        .mList li.empty:before {
            display: none;
        }

        .mList.gNoMargin {
            margin-top: 0;
        }

        /* mList + typeMore */
        p.mList.typeMore,
        ul.mList.typeMore > li {
            color: #1b1e26;
            font-size: 12px;
            text-align: left;
        }

        html:lang(ko) p.mList.typeMore,
        html:lang(ko) ul.mList.typeMore > li {
            font-size: 13px;
        }

        p.mList.typeMore:before,
        ul.mList.typeMore > li:before {
            top: 9px;
            background-color: #1b1e26;
        }

        ol.mList.typeMore > li {
            color: #1b1e26;
            font-size: 12px;
        }

        html:lang(ko) ol.mList.typeMore > li {
            font-size: 13px;
        }

        /* mList + typeMore + gIndent */
        p.mList.typeMore.gIndent,
        ul.mList.typeMore.gIndent {
            margin-left: 15px;
        }

        ol.mList.typeMore.gIndent {
            margin-left: 30px;
        }

        /* mList Reset */
        .mTooltip .mList {
            margin: 0 0 0 6px;
        }

        .mTooltip .mList li a strong {
            margin: 0 0 0 5px;
        }

        .gGoods .mTooltip .content ul.mList {
            padding-left: 0;
        }

        .gGoods .mTooltip .content p.mList {
            padding-left: 9px;
        }

        .mTooltip .mList li > ol > li, .mTooltip .mList li.empty li, .mTooltip ol.mList ol > li {
            margin-left: 9px;
        }

        .mTooltip ul.mList ol > li {
            margin-left: 0;
        }

        .mTooltip ol.mList > li, .mTooltip ul.mList > li > ol > li, .mTooltip ul.mList li li > ol > li {
            padding-left: 0;
            list-style: none;
        }

        .mTooltip ol.mList > li:before, .mTooltip ul.mList > li > ol > li:before, .mTooltip ul.mList li li > ol > li:before {
            display: none;
        }

        .mTooltip ol.mList ul > li {
            position: relative;
            margin-left: 9px;
            padding-left: 9px;
        }

        .mTooltip ol.mList ul > li:before {
            content: "";
            position: absolute;
            top: 6px;
            left: 0;
            width: 5px;
            height: 1px;
            background-color: #898989;
        }

        .mBoard p.mList:first-child, .mBoard ul.mList:first-child, .mBoard ol.mList:first-child, .mBox .mList:first-child, .mList .mList, .mGridTable ul.mList:first-child {
            margin-top: 0;
        }

        .mZipcode p.mList.typeMore, .mZipcode ul.mList.typeMore {
            margin-bottom: 5px;
        }

        .mLayer .mList:first-child {
            margin-top: 0;
        }

        /* mHelp */
        .mHelp {
            margin: 30px 0 0;
            padding: 16px 20px 20px;
            border: 1px solid #e4e4e6;
            background-color: #f6f7f7;
        }

        .mHelp h2 {
            margin: 20px 0 0;
            padding: 2px 0 0 30px;
            font-size: 12px;
            line-height: 18px;
            font-weight: bold;
            color: #010101;
            background: url("//img.echosting.cafe24.com/suio/sflex_help.png") no-repeat -482px 1px;
        }

        html:lang(ko) .mHelp h2 {
            font-size: 13px;
        }

        .mHelp h2:first-child {
            margin: 0;
        }

        .mHelp h2.tip {
            padding-top: 0;
            background-position: -428px -99px;
        }

        .mHelp .content {
            margin: 0 0 0 30px;
            font-size: 12px;
            line-height: 1.25;
            color: #555;
        }

        html:lang(ko) .mHelp .content {
            font-size: 13px;
        }

        .mHelp .content h3 {
            margin: 15px 0 10px;
            font-size: 12px;
            font-weight: bold;
            color: #333;
            line-height: 16px;
        }

        html:lang(ko) .mHelp .content h3 {
            font-size: 13px;
        }

        .mHelp ol,
        .mHelp ul,
        .mHelp p {
            margin: 5px 0 0;
            line-height: 1.5;
        }

        .mHelp li {
            margin: 2px 0 0;
        }

        .mHelp li ol,
        .mHelp li ul {
            margin: 0 0 5px 10px;
        }

        .mHelp li > ol,
        .mHelp li > ul {
            margin-top: 0;
        }

        .mHelp li p {
            margin: 2px 0 0;
        }

        .mHelp li > p {
            margin: 2px 0 5px 10px;
        }

        .mHelp p,
        .mHelp ul > li {
            padding: 0 0 0 10px;
            background: url("//img.echosting.cafe24.com/suio/sflex_help.png") no-repeat -395px -192px;
        }

        .mHelp ul > li > ul > li {
            padding: 0 0 0 7px;
            background: url("//img.echosting.cafe24.com/suio/sflex_help.png") no-repeat -298px -392px;
        }

        .mHelp .mBoard {
            margin: 5px 0 10px;
        }

        .mHelp ul.empty li,
        .mHelp p.empty,
        .mHelp li.empty {
            padding-left: 0;
            background: none;
        }

        .mHelp .content > p:first-child {
            margin-top: 10px;
        }

        .mHelp a,
        .mHelp .btnLink {
            color: #479aed;
            font-size: 12px;
        }

        html:lang(ko) .mHelp a,
        html:lang(ko) .mHelp .btnLink {
            font-size: 13px;
        }

        .mHelp a strong,
        .mHelp .btnLink strong {
            font-weight: normal;
        }

        .mHelp .btnLink {
            display: inline-block;
        }

        .mHelp .law {
            padding: 10px 15px;
            margin-top: 5px;
            color: #555;
            border: 1px solid #e8e8e8;
            background-color: #ffffff;
        }

        .mHelp .law .title {
            margin: 0;
            padding: 0;
            background: none;
        }

        .mHelp .law .title h3 {
            display: inline-block;
            margin: 0;
            font-size: 12px;
            color: #333;
            vertical-align: middle;
        }

        html:lang(ko) .mHelp .law .title h3 {
            font-size: 13px;
        }

        .mHelp .icoDesign {
            text-decoration: none;
            color: transparent;
        }

        .mHelp .mBoard ul, .mHelp .mBoard ol, .mHelp .mBoard p {
            margin-top: 0;
        }

        .mHelp .inquiry {
            margin: 20px 0 0 0;
            padding: 18px 27px 17px;
            font-family: "굴림";
            color: #333;
            border: 1px solid #e4e4e6;
            background-color: #fff;
        }

        html:lang(ja) .mHelp .inquiry {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mHelp .inquiry {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mHelp .inquiry {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mHelp .inquiry .title {
            display: inline-block;
            line-height: 17px;
        }

        .mHelp .inquiry .title:after {
            content: "";
            display: inline-block;
            width: 1px;
            height: 17px;
            margin: 0 18px 0 20px;
            vertical-align: -4px;
            background-color: #e4e4e6;
        }

        .mHelp .inquiry .info {
            display: inline-block;
        }

        .mHelp .btnDirect {
            text-decoration: underline;
            color: #1b87d4;
        }

        .mHelp .btnDirect:after {
            content: "";
            display: inline-block;
            width: 5px;
            height: 7px;
            margin: 0 0 0 5px;
            background: url('//img.echosting.cafe24.com/suio/sflex_help.png') -245px -500px no-repeat;
        }

        /* mAdvice */
        .mAdvice {
            margin: 5px 0 0;
            padding: 0 10px;
            border: 1px solid #e4e4e6;
            text-align: left;
            background-color: #f6f7f7;
        }

        .mAdvice strong.title {
            display: block;
            margin: 7px 0;
            padding: 0 0 0 22px;
            font-size: 12px;
            font-weight: bold;
            color: #000;
            line-height: 16px;
            background: url("//img.echosting.cafe24.com/suio/sflex_help.png") no-repeat -337px -299px;
        }

        html:lang(ko) .mAdvice strong.title {
            font-size: 13px;
        }

        .mAdvice .content {
            margin: 7px 0 10px 22px;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 1.25;
            color: #6f6f6f;
        }

        .mAdvice ol,
        .mAdvice ul,
        .mAdvice p {
            margin: 4px 0 0;
        }

        .mAdvice li {
            margin: 2px 0 0;
        }

        .mAdvice li ol,
        .mAdvice li ul {
            margin-left: 10px;
            margin-bottom: 5px;
        }

        .mAdvice li > ol,
        .mAdvice li > ul {
            margin-top: 0;
        }

        .mAdvice ul > li {
            padding: 0 0 0 10px;
            background: url("//img.echosting.cafe24.com/suio/sflex_help.png") no-repeat -395px -194px;
        }

        .mAdvice ul > li > ul > li {
            padding: 0 0 0 7px;
            background: url("//img.echosting.cafe24.com/suio/sflex_help.png") no-repeat -298px -395px;
        }

        .mAdvice.typeInfo {
            background-color: #f1f1f9;
        }

        .mAdvice.typeInfo ul.empty li {
            background: none;
        }

        /* mLayer > mAdvice */
        .mLayer .mAdvice strong.title {
            padding-left: 0;
            background: none;
        }

        .mLayer .mAdvice .content {
            margin-left: 0;
        }

        /* mBoard > mAdvice */
        .mBoard .mAdvice p.empty {
            border: 0;
            padding: 0;
            text-align: inherit;
        }

        .mLayer .mPaginate + .mAdvice {
            margin-top: 20px;
        }

        .mAdvice.typeInfo > .head {
            margin: 6px 0 0;
        }

        .mAdvice.typeInfo > .head strong.title {
            display: inline-block;
        }

        /* ----------------------------------------- // Element & Text Module  ----------------------------------------- */


        /* ----------------------------------------- Board ----------------------------------------- */

        /* mBoard */
        .mBoard table {
            line-height: 1.5;
            background-color: #fff;
            font-size: 12px;
        }

        .mBoard.typeFixed > table {
            width: auto;
        }

        .mBoard th,
        .mBoard td {
            padding: 9px 9px 7px;
            vertical-align: top;
        }

        html:lang(en) .mBoard th,
        html:lang(en) .mBoard td {
            word-break: break-word;
        }

        .mBoard th {
            font-weight: normal;
            background-color: #fafafb;
        }

        .mBoard tbody th {
            border: 1px solid #d9dadc;
            text-align: left;
        }

        .mBoard tbody th[scope*='col'] {
            text-align: center;
        }

        .mBoard thead th {
            border: 1px solid #d9dadc;
            text-align: center;
            vertical-align: middle;
        }

        .mBoard tbody td {
            border: 1px solid #d9dadc;
        }

        .mBoard tfoot th {
            border: 1px solid #d9dadc;
            font-weight: bold;
            background-color: #fafafb;
        }

        .mBoard tfoot td {
            border: 1px solid #d9dadc;
            background-color: #fafafb;
        }

        /* IE10+ border-collapse:collapse 사용시 border-top 숨는 문제 */
        .mBoard table {
            border-top: 1px solid #d9dadc;
        }

        .mBoard tfoot > tr > th,
        .mBoard tbody > tr > td {
            border-top-width: 0;
        }

        .mBoard tbody > tr > td .mLayer td {
            border-top-width: 1px;
        }

        /* 테이블의 합계가 상단에 위치할때  */
        .mBoard .tfoot th {
            border: 1px solid #d9dadc;
            text-align: center;
            font-weight: bold;
            background: #fafafa;
        }

        .mBoard .tfoot td {
            border: 1px solid #d9dadc;
            background: #fafafa;
        }

        .mBoard .tfoot .sum th {
            background: #e8ebed;
        }

        .mBoard .tfoot .sum td {
            font-weight: bold;
            background: #e8ebed;
        }

        /* .mBoard.typeDivide */
        .mBoard.typeDivide {
            margin-top: 10px;
        }

        .mBoard.typeDivide table {
            border: 0;
        }

        .mBoard.typeDivide thead {
            overflow: hidden;
            position: absolute;
            width: 0;
            height: 0;
            white-space: nowrap;
            text-indent: 150%;
            font-size: 0;
            line-height: 0;
        }

        .mBoard.typeDivide tbody td {
            border-top-width: 1px;
        }

        html:lang(ko) .mBoard thead th,
        html:lang(ko) .mBoard thead ~ tbody td,
        html:lang(ko) .mBoard thead ~ tbody td a,
        html:lang(ko) .mBoard thead ~ tfoot th,
        html:lang(ko) .mBoard thead ~ tfoot td,
        html:lang(ko) .mBoard.typeList tbody th,
        html:lang(ko) .mBoard.typeList tbody td,
        html:lang(ko) .mBoard.typeList tbody td a,
        html:lang(ko) .mBoard .empty {
            color: #222;
            font-family: "Nanum Gothic", "맑은 고딕", "malgun gothic", "Apple SD Gothic Neo", sans-serif;
        }

        html:lang(ko) .mBoard .mBoard thead th,
        html:lang(ko) .mBoard .mBoard thead ~ tbody td,
        html:lang(ko) .mBoard .mBoard thead ~ tbody td a,
        html:lang(ko) .mBoard .mBoard thead ~ tfoot th,
        html:lang(ko) .mBoard .mBoard thead ~ tfoot td,
        html:lang(ko) .mBoard thead ~ tbody td .btnNormal,
        html:lang(ko) .mBoard thead ~ tbody td .btnEm {
            font-family: "Noto Sans KR", sans-serif;
        }

        .mBoard .left {
            text-align: left;
        }

        .mBoard .center {
            text-align: center;
        }

        .mBoard .right {
            text-align: right;
        }

        .mBoard .middle, .mBoard .middle th, .mBoard .middle td {
            vertical-align: middle;
        }

        .mBoard .top, .mBoard .middle .top {
            vertical-align: top;
        }

        .mBoard .chk {
            width: 35px;
        }

        .mBoard .chkTxt {
            width: 43px;
        }

        .mBoard .date {
            width: 100px;
        }

        .mBoard .time {
            width: 144px;
        }

        html:lang(ja) .mBoard .time {
            width: 148px;
        }

        .mBoard .gDivision,
        .mBoard.gDivision {
            margin: -1px 0 0;
        }

        .mBoard.gCell thead th {
            padding-left: 4px;
            padding-right: 4px;
        }

        .mBoard.gCell td {
            padding: 8px;
        }

        .mBoard.gCellSingle td {
            padding-top: 4px;
            padding-bottom: 4px;
        }

        .mBoard.gCellNarrow td {
            padding-left: 4px;
            padding-right: 4px;
        }

        .mBoard.gCellEmpty td,
        .mBoard .gCellEmpty {
            padding: 0;
        }

        .mBoard.gCellDense {
            font-size: 11px;
            letter-spacing: 0;
        }

        .mBoard.gCellDense th,
        .mBoard.gCellDense td {
            padding: 3px 10px 2px;
            line-height: 1.4;
            vertical-align: middle;
        }

        .mBoard.gCellDense thead th {
            padding: 3px 0 2px;
        }

        .mBoard td.exImg {
            padding: 0;
        }

        .mBoard .gEditor {
            margin: 0 0 3px;
        }

        .mBoard .gEditor table.seLayout {
            border: 1px solid #e1e1e1;
            border-bottom: 0;
        }

        .mBoard .gEditor table table,
        .mBoard .gEditor td {
            width: auto;
            min-width: 0;
        }

        .gEditor table table,
        .gEditor td {
            width: auto;
            min-width: 0;
        }

        .gEditor input,
        .gEditor textarea {
            outline: 0 none;
        }

        .gEditor > table {
            background: #dee2e5;
        }

        .gEditor .butClass {
            border: 1px solid #dee2e5;
            background: #dee2e5;
        }

        .gEditor #editctrl {
            border: 1px solid #dee2e5;
        }

        .gEditor #editctrl > iframe {
            border: 0;
        }

        .mBoard .hover {
            background-color: #fafafb;
        }

        .mBoard .selected {
            background-color: #f4f9ff;
        }

        .mBoard .negative {
            background-color: #feeef0;
        }

        .mBoard .positive {
            background-color: #fff5d8;
        }

        .mBoard .bgDivision {
            background-color: #ebfbf4;
        }

        .mBoard .empty td,
        .mBoard p.empty,
        .mBoard div.empty {
            margin-top: -1px;
            border: 1px solid #d9dadc;
            padding: 100px 0;
            text-align: center;
            background-color: #fff;
        }

        .mBoard .mBoard .empty td,
        .mBoard .mBoard p.empty {
            padding: 20px 0;
        }

        .mBoard p.empty,
        .mBoard div.empty {
            margin-top: 0;
            border-top-width: 0;
        }

        .mBoard.gScroll p.empty {
            border-right-width: 0;
            border-left-width: 0;
        }

        .mBoardArea p.empty {
            border-right-width: 0;
            border-bottom-width: 0;
        }

        .mBoard div.empty .mList {
            display: inline-block;
        }

        .mBoard .mBoard .mButton {
            margin-bottom: 10px;
        }

        .mBoard .array {
            display: inline-block;
            cursor: pointer;
        }

        .mBoard .array span {
            display: inline-block;
            line-height: 14px;
            vertical-align: middle;
        }

        .mBoard .array:hover,
        .mBoard .array:hover span {
            color: #1c1c1c;
            text-decoration: underline;
        }

        .mBoard .array.descend,
        .mBoard .array.ascend,
        .mBoard .array.descend:hover span,
        .mBoard .array.ascend:hover span {
            color: #1b87d4;
        }

        .mBoard .array button {
            overflow: hidden;
            display: inline-block;
            width: 7px;
            height: 4px;
            margin: 0 0 0 5px;
            vertical-align: 4px;
            white-space: nowrap;
            text-indent: 150%;
            font-size: 0;
            line-height: 0;
            background: url("//img.echosting.cafe24.com/suio/sfix_btn.png") no-repeat 0 -21px;
        }

        .mBoard .array:hover button {
            background-position: -17px -21px;
        }

        .mBoard .array.ascending button {
            background-position: 0 -49px;
        }

        .mBoard .array.ascending:hover button {
            background-position: -17px -49px;
        }

        .mBoard .array.descend button {
            background-position: 0 -35px;
        }

        .mBoard .array.ascend button {
            background-position: -17px -35px;
        }

        .mBoard .eInlay a.active {
            font-weight: bold;
            letter-spacing: -1px;
        }

        .mBoard .gInlay,
        .mGridTable .gInlay {
            display: none;
        }

        .mBoard .gInlay.enabled,
        .mGridTable .gInlay.enabled {
            display: table-row;
        }

        .mBoard .mGoods {
            margin: -5px 0 0;
        }

        .mBoard .mGoods .check {
            float: left;
            padding: 15px 0 0;
        }

        .mBoard .mGoods .gGoods {
            margin: 5px 0 0;
        }

        .mBoard .gGoods {
            position: relative;
            text-align: left;
        }

        .mBoard .gGoods:after {
            content: "";
            display: block;
            clear: both;
        }

        .mBoard .gGoods .frame {
            float: left;
            margin: 0 0 2px;
        }

        .mBoard .gGoods .option,
        .mBoard .gGoods .option a {
            margin: 4px 0 0;
            color: #3971ff;
            font-size: 12px;
            line-height: 20px;
        }

        html:lang(ko) .mBoard .gGoods .option,
        html:lang(ko) .mBoard .gGoods .option a {
            font-size: 13px;
        }

        .mBoard .gGoods .etc,
        .mBoard .gGoods .etc a {
            margin: 4px 0 0;
            color: #3971ff;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 16px;
        }

        .mBoard .gGoods .set,
        .mBoard .gGoods .set a {
            margin: 4px 0 0;
            color: #3971ff;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 16px;
        }

        .mBoard .gGoods li {
            padding: 0 0 0 9px;
            margin: 0;
            background: url("//img.echosting.cafe24.com/suio/sflex_ico.png") no-repeat -395px -194px;
        }

        .mBoard .gGoods .set li {
            margin: 0;
            padding-left: 0;
            background: none;
        }

        .mBoard .gGoods .set li li {
            padding: 0 0 0 9px;
            background: url("//img.echosting.cafe24.com/suio/sflex_ico.png") no-repeat -395px -194px;
        }

        .mBoard .gGoods .set li ul {
            margin: 0 0 0 10px;
            padding: 0 0 3px;
        }

        .mBoard .gGoods .other {
            margin: 3px 0 0;
            color: #777;
            font-size: 11px;
            letter-spacing: 0;
        }

        .mBoard .gGoods.gSmall p,
        .mBoard .gGoods.gSmall ul {
            padding: 0 0 0 44px;
        }

        .mBoard .gGoods.gMedium p,
        .mBoard .gGoods.gMedium ul {
            padding: 0 0 0 59px;
        }

        .mBoard .gGoods.gLarge p,
        .mBoard .gGoods.gLarge ul {
            padding: 0 0 0 119px;
        }

        .mBoard .gGoods.gMedium ul ul {
            padding: 0 0 3px;
        }

        .mBoard .gGoods.gCheck .fChk {
            float: left;
            margin: 0 3px 0 0;
        }

        .mBoard .gGoods.gSmall.gCheck p {
            padding: 0 0 0 61px;
        }

        .mBoard .gGoods.gSmall.gCheck ul {
            padding: 0 0 0 59px;
        }

        .mBoard .gGoods.gSmall.gCheck ul ul {
            padding: 0 0 3px;
        }

        .mBoard .gGoods.gMedium.gCheck p,
        .mBoard .gGoods.gMedium.gCheck ul {
            padding: 0 0 0 76px;
        }

        .mBoard .gGoods.gMedium.gCheck ul ul {
            padding: 0 0 3px;
        }

        .mBoard .gGoods.gFunction {
            padding: 0 30px 0 0;
        }

        .mBoard .gGoods.gFunction .icoView {
            position: absolute;
            top: 0;
            right: 0;
        }

        .mBoard .gBtnFixed,
        .mGridTable .gBtnFixed {
            position: relative;
        }

        .mBoard .gBtnFixed .txt {
            padding: 0 45px 0 0;
        }

        .mBoard .gBtnFixed .button,
        .mGridTable .gBtnFixed .button {
            position: absolute;
            right: 0;
            top: -2px;
        }

        .mBoard .gBtnFixed .input,
        .mGridTable .gBtnFixed .input {
            padding: 0 48px 0 0;
        }

        .mBoard .gBtnFixed .input + .button,
        .mGridTable .gBtnFixed .input + .button {
            top: 1px;
        }

        .mBoard .gBtnFixed .button a {
            float: left;
            margin: 0 0 0 4px;
        }

        .mBoard .gMemo {
            overflow: hidden;
        }

        .mBoard .gMemo textarea {
            float: left;
        }

        .mBoard .gMemo .button {
            float: left;
            margin: 0 0 0 5px;
        }

        .mBoard .gMemo .button a,
        .mBoard .gMemo .button button {
            margin: 0 0 5px;
        }

        .mBoard .gColumnSet .column {
            display: table-cell;
            padding: 0 5px 0 0;
            vertical-align: top;
            text-align: left;
            word-break: break-all;
        }

        .mBoard .gColumnSet.middle .column {
            vertical-align: middle;
        }

        .mBoard .gColumnSet.full {
            display: table;
            table-layout: fixed;
            width: 100%;
        }

        .mBoard .gComment {
            position: relative;
            padding: 5px 0 0 13px;
        }

        .mBoard .gComment:before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            width: 7px;
            height: 7px;
            border: 1px solid #bfbfbf;
            border-width: 0 0 1px 1px;
        }

        .mBoard .gComment .figure {
            margin: 8px 0;
        }

        .mBoard.gScroll {
            position: relative;
            overflow: auto;
            border-right: 1px solid #d9dadc;
            border-left: 1px solid #d9dadc;
            background-color: #fff;
        }

        .mBoard.gScroll table {
            margin-left: -1px;
        }

        .mBoard.gScroll th,
        .mBoard.gScroll td {
            border-right-width: 0;
        }

        .mBoard.gScroll .mLayer th,
        .mBoard.gScroll .mLayer td {
            border-right-width: 1px;
        }

        .mBoard.gScroll .mBoard {
            border-right: 1px solid #d9dadc;
        }

        .mBoard.gScroll .mBoard table {
            margin-left: 0;
        }

        .mBoardArea.gNoScroll .mBoard.typeBody {
            overflow: visible;
            max-height: none;
        }

        .mBoardArea .mBoard.typeHead {
            border-right: 1px solid #d9dadc;
        }

        .mBoardArea .mBoard.typeHead th {
            border-right: 0;
            color: #80878d;
            text-align: center;
            vertical-align: middle;
        }

        .mBoardArea .mBoard.typeBody {
            position: relative;
            overflow-x: hidden;
            overflow-y: scroll;
            max-height: 185px;
            min-height: 100px;
            border-bottom: 1px solid #d9dadc;
            border-right: 1px solid #d9dadc;
            background: url("//img.echosting.cafe24.com/suio/bg_mBoardArea.gif") repeat-y 0 0;
        }

        .mBoardArea .mBoard.typeBody table {
            border-top: 0;
        }

        .mBoardArea .mBoard.typeBody td {
            border: 0;
            border-bottom: 1px solid #d9dadc;
            border-left: 1px solid #d9dadc;
        }

        .mBoardArea .mBoard.typeBody .empty td {
            border-bottom-width: 0;
        }

        .mBoardArea .mBoard.typeBody .mBoard .empty td {
            border-bottom-width: 1px;
        }

        .mBoardArea .mBoard.typeBody td td {
            border-top: 1px solid #d9dadc;
            border-right: 1px solid #d9dadc;
        }

        .mBoardArea .mBoard.typeBody.gClearHeight {
            max-height: none;
        }

        .mBoardArea .mBoard.typeFoot {
            margin-top: -1px;
        }

        .mBoardArea .mBoard.typeFoot th {
            border: 1px solid #d9dadc;
            color: #80878d;
            font-weight: bold;
            background-color: #fafafa;
        }

        .mBoardArea .mBoard.typeFoot td {
            border: 1px solid #d9dadc;
            background-color: #fafafa;
        }

        .mBoard.gSmall th {
            width: 135px;
        }

        .mBoard.gSmall td {
            width: auto;
        }

        .mBoard.gMedium th {
            width: 155px;
        }

        .mBoard.gMedium td {
            width: auto;
        }

        .mBoard.gLarge th {
            width: 180px;
        }

        .mBoard.gLarge td {
            width: auto;
        }

        .mBoard.gSmall thead th, .mBoard.gMedium thead th, .mBoard.gLarge thead th {
            width: auto;
        }

        .mBoard.gSmall .typeHead th, .mBoard.gMedium .typeHead th, .mBoard.gLarge .typeHead th {
            width: auto;
        }

        .mBoard.typeFixed > table > tbody > tr > th {
            width: auto;
        }

        /* mBoard Reset */
        #popup .mBoard.gSmall th {
            width: 115px;
        }

        #popup .mBoard.gMedium th {
            width: 125px;
        }

        #popup .mBoard.gLarge th {
            width: 145px;
        }

        #popup .mBoard .mBoard.gSmall th {
            width: 115px;
        }

        #popup .mBoard .mBoard.gMedium th {
            width: 125px;
        }

        #popup .mBoard .mBoard.gLarge th {
            width: 145px;
        }

        #popup .mBoard.gSmall thead th, #popup .mBoard.gMedium thead th, #popup .mBoard.gLarge thead th {
            width: auto;
        }

        #popup .mBoard.gSmall .typeHead th, #popup .mBoard.gMedium .typeHead th, #popup .mBoard.gLarge .typeHead th {
            width: auto;
        }

        #popup .mLayer .mBoard.gSmall th {
            width: 75px;
        }

        #popup .mLayer .mBoard.gMedium th {
            width: 100px;
        }

        #popup .mLayer .mBoard.gLarge th {
            width: 135px;
        }

        #popup .mLayer .mBoard.gSmall thead th, #popup .mLayer .mBoard.gMedium thead th, #popup .mLayer .mBoard.gLarge thead th {
            width: auto;
        }

        .mLayer .mBoard.gSmall th {
            width: 75px;
        }

        .mLayer .mBoard.gMedium th {
            width: 100px;
        }

        .mLayer .mBoard.gLarge th {
            width: 135px;
        }

        .mZipcode .mBoard {
            margin: 0 0 10px;
        }

        .mTooltip .mBoard table {
            font-size: 11px;
            letter-spacing: 0;
        }

        .mTooltip .mBoard th,
        .mTooltip .mBoard td {
            padding: 7px 5px 5px;
        }

        .mTooltip .mBoard tbody th {
            border: 1px solid #ebebeb;
        }

        .mTooltip .mBoard thead th {
            border: 1px solid #ebebeb;
            color: #1c1c1c;
        }

        .mTooltip .mBoard tbody td {
            border: 1px solid #ebebeb;
        }

        .mTooltip .mBoard tfoot th {
            border: 1px solid #ebebeb;
            color: #1c1c1c;
        }

        .mTooltip .mBoard tfoot td {
            border: 1px solid #ebebeb;
        }

        /* mOpen > mBoard */
        .mOpen .mBoard {
            padding: 10px;
        }

        /* mBox + mBoard */
        .mBox + .mBoard {
            margin-top: 20px;
        }

        /* mPaginate */
        .mPaginate {
            margin: 16px 0 0;
            text-align: center;
        }

        .mPaginate li a,
        .mPaginate strong {
            display: inline-block;
            width: 24px;
            height: 24px;
            font-size: 14px;
            line-height: 24px;
            color: #444b59;
            text-decoration: none;
        }

        .mPaginate ol,
        .mPaginate li {
            display: inline-block;
            margin: 0 4px;
            font-size: 0;
            line-height: 0;
            vertical-align: middle;
        }

        .mPaginate a:hover {
            background-color: #e1e8f9;
        }

        .mPaginate a:active,
        .mPaginate a:focus,
        .mPaginate strong {
            color: #fff;
            background-color: #3971ff;
        }

        .mPaginate .prev,
        .mPaginate .next,
        .mPaginate .first,
        .mPaginate .last {
            overflow: hidden;
            display: inline-block;
            width: 24px;
            height: 24px;
            padding: 0;
            vertical-align: middle;
            font-size: 0;
            line-height: 0;
            text-align: center;
            border: 1px solid #d6dae1;
            background-color: #fff;
            box-sizing: border-box;
        }

        .mPaginate .prev {
            margin: 0 4px 0 0;
        }

        .mPaginate .next {
            margin: 0 0 0 4px;
        }

        .mPaginate .prev:before,
        .mPaginate .next:before,
        .mPaginate .first:before,
        .mPaginate .last:before {
            content: "";
            display: inline-block;
            width: 4px;
            height: 4px;
            vertical-align: middle;
            border-left: 1px solid #444b59;
            border-bottom: 1px solid #444b59;
        }

        .mPaginate .prev:before {
            margin: 9px 0 0 2px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .mPaginate .next:before {
            margin: 9px 2px 0 0;
            -webkit-transform: rotate(-135deg);
            transform: rotate(-135deg);
        }

        .mPaginate .first:before {
            margin: 6px 0 0;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .mPaginate .last:before {
            margin: 6px 0 0;
            -webkit-transform: rotate(-135deg);
            transform: rotate(-135deg);
        }

        .mPaginate .first:after,
        .mPaginate .last:after {
            content: "";
            display: inline-block;
            width: 1px;
            height: 11px;
            margin: 3px 0 0;
            vertical-align: middle;
            background-color: #444b59;
        }

        .mPaginate .first:after {
            margin: 6px 1px 0 -11px;
        }

        .mPaginate .last:after {
            margin: 6px 0 0 5px;
        }

        /* typeTotal */
        .mPaginate.typeTotal {
            position: relative;
            z-index: 1;
            margin: -1px 0 0;
            padding: 7px 0;
            border: 1px solid #bbc0c4;
            text-align: center;
            background: #f6f6f6;
            background: -moz-linear-gradient(top, #fdfdfd 3%, #f6f6f6 100%);
            background: -webkit-linear-gradient(top, #fdfdfd 3%, #f6f6f6 100%);
            background: linear-gradient(to bottom, #fdfdfd 3%, #f6f6f6 100%);
        }

        .mPaginate.typeTotal a {
            display: inline-block;
            overflow: hidden;
            width: 23px;
            height: 20px;
            border: 1px solid transparent;
            text-decoration: none;
            font-size: 0;
            line-height: 0;
            vertical-align: top;
        }

        .mPaginate.typeTotal a:hover {
            color: #25baff;
            border-color: #7cbfec;
            border-radius: 2px;
            text-decoration: none;
            box-shadow: inset -1px 1px #f4f9fd;
            background: #d5e9f6;
        }

        .mPaginate.typeTotal a span {
            display: inline-block;
            position: relative;
            width: 0;
            height: 0;
            margin-top: 5px;
            border-style: solid;
            font-size: 0;
            line-height: 0;
        }

        .mPaginate.typeTotal p {
            display: inline-block;
            height: 22px;
            margin: 0 10px;
            line-height: 22px;
            color: #5d5d5d;
        }

        .mPaginate.typeTotal input {
            width: 34px;
            padding: 2px 0 3px;
            margin: 0 2px 0 0;
            border-style: solid;
            border-width: 1px;
            border-color: #a7a7a7 #cfcfcf #cfcfcf #a7a7a7;
            outline: none;
            vertical-align: top;
            text-align: center;
            color: #5d5d5d;
        }

        .mPaginate.typeTotal .btnPrev span {
            margin-right: 2px;
        }

        .mPaginate.typeTotal .btnPrev span,
        .mPaginate.typeTotal .btnFirst span {
            border-width: 5px 5px 5px 0;
            border-color: transparent #5a5a5a transparent transparent;
        }

        .mPaginate.typeTotal .btnFirst span:before {
            content: '';
            position: absolute;
            top: -4px;
            left: -2px;
            width: 1px;
            height: 9px;
            background: #5a5a5a;
        }

        .mPaginate.typeTotal .btnNext span {
            margin-left: 2px;
        }

        .mPaginate.typeTotal .btnNext span,
        .mPaginate.typeTotal .btnLast span {
            border-width: 5px 0 5px 5px;
            border-color: transparent transparent transparent #5a5a5a;
        }

        .mPaginate.typeTotal .btnLast span:before {
            content: '';
            position: absolute;
            top: -4px;
            right: -2px;
            width: 1px;
            height: 9px;
            background: #5a5a5a;
        }

        .mPaginate.typeTotal .btnPrev:hover span,
        .mPaginate.typeTotal .btnFirst:hover span {
            border-color: transparent #13476c transparent transparent;
        }

        .mPaginate.typeTotal .btnNext:hover span,
        .mPaginate.typeTotal .btnLast:hover span {
            border-color: transparent transparent transparent #13476c;
        }

        .mPaginate.typeTotal .btnFirst:hover span:before,
        .mPaginate.typeTotal .btnLast:hover span:before {
            background-color: #13476c;
        }

        .mBoard + .mPaginate.typeTotal,
        .mBoardArea + .mPaginate.typeTotal {
            margin: -1px 0 0;
        }

        /* typeMore */
        .mPaginate.typeMore .button {
            display: block;
            width: 100%;
            font-size: 13px;
            color: #1c1c1c;
            font-weight: bold;
            text-align: center;
            line-height: 34px;
            border: 1px solid #b6bbc1;
            background-color: #f7f7f7;
        }

        .mPaginate.typeMore .button em.icoLower {
            position: relative;
            display: inline-block;
            width: 9px;
            height: 11px;
            margin: 0 0 0 2px;
            padding: 0;
            vertical-align: -2px;
            line-height: 0;
        }

        .mPaginate.typeMore .button em.icoLower:after {
            content: "";
            position: absolute;
            top: 0;
            left: 4px;
            width: 5px;
            height: 5px;
            border: 2px solid #868e9b;
            border-bottom: 0;
            border-right: 0;
            -webkit-transform: rotate(-135deg);
            -ms-transform: rotate(-135deg);
            transform: rotate(-135deg);
        }


        /* ----------------------------------------- // Board  ----------------------------------------- */


        /* ----------------------------------------- mSearchEngine & mGridTable ----------------------------------------- */
        /*mSelect*/
        .mSelect.gDrop li {
            padding: 5px 25px 5px 5px;
        }

        .mSelect.gDrop li strong {
            word-wrap: break-word;
        }

        /* mSearchEngine */
        .mSearchEngine {
            position: relative;
            padding: 0 0 40px;
        }

        .mSearchEngine:after {
            content: "";
            position: absolute;
            bottom: 36px;
            display: block;
            width: 100%;
            height: 4px;
            vertical-align: top;
            box-sizing: border-box;
            border: solid #b6bec9;
            border-width: 1px;
            background-color: #d4d9e1;
        }

        .mSearchEngine .mTitle {
            margin-top: 5px;
        }

        .mSearchEngine .search {
            display: table;
            table-layout: fixed;
            width: 100%;
            height: 100%;
            border: solid #bbc0c4;
            border-width: 1px 1px 0;
            box-sizing: border-box;
        }

        .mSearchEngine .search label {
            display: inline-block;
            padding: 0 10px 0 0;
            outline: 0;
            vertical-align: middle;
        }

        .mSearchEngine .fSelect.gLabel {
            margin: 0 15px 0 -5px;
        }

        /* UI control */
        .mSearchEngine.expandAll .search,
        .mSearchEngine.expandAll .btnFold {
            display: none;
        }

        .mSearchEngine.expand .search tr:not(.rowFix),
        .mSearchEngine.expand .btnFold {
            display: none;
        }

        .mSearchEngine.folder .search tr:not(.rowFold) {
            display: none;
        }

        /* gDefault */
        .mSearchEngine.gHidden .btnExpand,
        .mSearchEngine.gHidden .btnFold {
            display: none;
        }

        .mSearchEngine th,
        .mSearchEngine td {
            padding: 6px 9px 4px 18px;
            line-height: 1.8;
            border-bottom: 1px solid #ebebeb;
        }

        .mSearchEngine tr:last-child th,
        .mSearchEngine tr:last-child td {
            border-bottom: 0;
        }

        .mSearchEngine th {
            text-align: left;
        }

        .mSearchEngine .button {
            display: table-cell;
            width: 100px;
            padding: 0 8px;
            box-sizing: border-box;
            vertical-align: middle;
            border-left: 1px solid #ebebeb;
            text-align: center;
        }

        .mSearchEngine .button .btnEngine,
        .mSearchEngine .button .btnReset {
            display: inline-block;
            width: 100%;
            text-align: center;
            padding: 0 16px;
            font-family: '굴림', gulim;
            border-radius: 2px;
            box-sizing: border-box;
            line-height: 44px;
            font-size: 14px;
            font-weight: bold;
        }

        html:lang(ja) .mSearchEngine .button .btnReset {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mSearchEngine .button .btnReset {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mSearchEngine .button .btnReset {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mSearchEngine .button .btnEngine {
            color: #fff;
            border-bottom: 1px solid #0182b8;
            text-shadow: 1px 1px 0 #1e89ce;
            background: #32b0f6;
        }

        .mSearchEngine .button .btnReset {
            border: 1px solid #bebebe;
        }

        .mSearchEngine .button [class*="btn"] + [class*="btn"] {
            margin: 11px 0 0;
        }

        .mSearchEngine .button [class*="btn"].gFlex {
            padding: 0 5px;
        }

        /* mini */
        .mSearchEngine .button.mini {
            padding: 0 15px;
        }

        .mSearchEngine .button.mini .btnEngine,
        .mSearchEngine .button.mini .btnReset {
            padding: 0 8px;
            line-height: 22px;
            font-size: 12px;
        }

        html:lang(ko) .mSearchEngine .button.mini .btnEngine,
        html:lang(ko) .mSearchEngine .button.mini .btnReset {
            font-size: 13px;
        }

        .mSearchEngine .button.mini [class*="btn"] + [class*="btn"] {
            margin: 6px 0 0;
        }

        /* gSolid */
        .mSearchEngine .button.gSolid {
            width: 173px;
        }

        .mSearchEngine .button.gSolid .btnEngine,
        .mSearchEngine .button.gSolid .btnReset {
            width: 48%;
        }

        .mSearchEngine .button.gSolid [class*="btn"] + [class*="btn"] {
            margin: 0;
        }

        .mSearchEngine .button.gSolid [class*="btn"].gFlex {
            width: 90%;
        }

        .mSearchEngine .btnExpand,
        .mSearchEngine .btnFold {
            position: absolute;
        }

        .mSearchEngine .btnExpand {
            overflow: hidden;
            display: inline-block;
            left: 50%;
            bottom: 19px;
            text-align: center;
            margin-left: -51px;
            width: 102px;
            height: 18px;
            text-indent: 150%;
            z-index: 1;
            white-space: nowrap;
            background: url('//img.echosting.cafe24.com/pdm/wms/bg_search_expand.png') no-repeat;
        }

        .mSearchEngine .btnExpand:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 0;
            right: 0;
            margin: 0 auto;
            width: 0;
            height: 0;
            display: inline-block;
            border-style: solid;
            border-color: #657286 transparent;
            border-width: 0 4px 6px;
        }

        .mSearchEngine.expand .btnExpand:before {
            top: 4px;
            border-width: 6px 4px 0;
        }

        .mSearchEngine .btnFold {
            right: 0;
            bottom: 15px;
            color: #363636;
        }

        .mSearchEngine .btnFold:before {
            content: "";
            display: inline-block;
            width: 16px;
            height: 15px;
            margin: 0 4px 0 0;
            vertical-align: top;
            background: url('//img.echosting.cafe24.com/suio/ico_search_fold.png') no-repeat;
        }

        .mSearchEngine.folder .btnFold:before {
            background-position: -50px 0;
        }

        /* Margin */
        .mBox + .mSearchEngine,
        .mList + .mSearchEngine {
            margin-top: 10px;
        }

        /* mGridTable */
        .mGridTable {
            overflow: hidden;
            z-index: 0;
            border: 1px solid #bbc0c4;
            border-top: 0;
            box-sizing: border-box;
        }

        .mGridTable table {
            line-height: 1.5;
            background-color: #fff;
        }

        .mGridTable th, .mGridTable td {
            padding: 9px 9px 7px;
            box-sizing: border-box;
        }

        .mGridTable thead {
            background-color: #f0f0f0;
        }

        .mGridTable th {
            position: relative;
            font-weight: normal;
        }

        .mGridTable tbody th {
            border: 1px solid #d9dadc;
            text-align: left;
        }

        .mGridTable thead th {
            border: 1px solid #bcc0c3;
            color: #1d1d1d;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            letter-spacing: -1px;
        }

        .mGridTable tbody td {
            border: 1px solid #e2e2e2;
            height: 100%;
        }

        .mGridTable tfoot th {
            border: 1px solid #d9dadc;
            color: #80878d;
            font-weight: bold;
            background-color: #fafafa;
        }

        .mGridTable tfoot td {
            border: 1px solid #d9dadc;
            background-color: #fafafa;
        }

        .mGridTable thead th:first-child,
        .mGridTable tbody td:first-child,
        .mGridTable tfoot th:first-child {
            border-left-width: 0;
        }

        .mGridTable thead th:last-child,
        .mGridTable tbody td:last-child,
        .mGridTable tfoot td:last-child {
            border-right-width: 0;
        }

        .mGridTable .empty {
            width: 100%;
            padding: 50px 0;
            box-sizing: border-box;
            text-align: center;
        }

        .mGridTable thead th .txtBreak {
            display: block;
            width: 100%;
            min-width: 30px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        /* IE10+ border-collapse:collapse 사용시 border-top 숨는 문제 */
        .mGridTable table {
            border-top: 1px solid #d9dadc;
        }

        .mGridTable tfoot > tr > th,
        .mGridTable tbody > tr > td {
            border-top-width: 0;
        }

        .mGridTable tbody > tr > td .mLayer td {
            border-top-width: 1px;
        }

        .mGridTable tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        .mGridTable .bgClear tbody tr:nth-child(even) {
            background: none;
        }

        /* 테이블의 합계가 상단에 위치할때  */
        .mGridTable .tfoot th {
            border: 1px solid #d9dadc;
            text-align: center;
            color: #000;
            font-weight: bold;
            background: #fafafa;
        }

        .mGridTable .tfoot td {
            border: 1px solid #d9dadc;
            background: #fafafa;
        }

        .mGridTable .tfoot .sum th {
            background: #e8ebed;
        }

        .mGridTable .tfoot .sum td {
            font-weight: bold;
            background: #e8ebed;
        }

        /* eMultiTable */
        .mGridTable .grid-wrapper {
            z-index: 1;
        }

        .mGridTable .grid-wrapper,
        .mGridTable .grid-tfoot,
        .mGridTable .grid-fixed-column .grid-tbody {
            overflow: hidden;
            position: relative;
        }

        .mGridTable .grid-thead {
            position: relative;
        }

        .mGridTable .grid-fixed-body .grid-tbody,
        .mGridTable .grid-tbody {
            overflow: auto;
            position: relative;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-button {
            background-color: #f5f4f4;
            background-image: url('//img.echosting.cafe24.com/suio/sfix_scroll_arrow.png');
            background-repeat: no-repeat;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-button:vertical {
            height: 14px;
            border-left: 1px solid #d7d7d7;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-button:vertical:decrement {
            background-position: 2px 5px;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-button:vertical:increment {
            background-position: -13px 5px;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-button:horizontal {
            width: 14px;
            border-top: 1px solid #d7d7d7;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-button:horizontal:decrement {
            background-position: 5px -13px;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-button:horizontal:increment {
            background-position: -10px -13px;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-track {
            background: #f5f4f4;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-track:vertical {
            border-left: 1px solid #d7d7d7;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-track:horizontal {
            border-top: 1px solid #d7d7d7;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-thumb {
            border: 1px solid #a4acb2;
            background: #d4d8de;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-thumb:vertical {
            border-right: 0;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-thumb:horizontal {
            border-bottom: 0;
        }

        .mGridTable .grid-tbody::-webkit-scrollbar-corner {
            border-top: 1px solid #d7d7d7;
            background: #f5f4f4;
        }

        .mGridTable .grid-tbody thead th {
            overflow: hidden;
            max-height: 50px;
        }

        .mGridTable .grid-fixed-column {
            position: absolute;
            top: 0;
            left: 0;
        }

        .mGridTable .grid-fixed-column {
            z-index: 3;
        }

        .mGridTable .grid-fixed-column .grid-thead {
            z-index: 1;
        }

        .mGridTable .grid-fixed-column table {
            border-top: 0;
        }

        .mGridTable .grid-fixed-column thead th:last-child,
        .mGridTable .grid-fixed-column tbody td:last-child {
            border-right: 1px solid #97989a;
        }

        .mGridTable .grid-fixed-body .grid-thead thead th,
        .mGridTable .grid-fixed-column .grid-thead thead th {
            border-bottom-color: #97989a;
        }

        .mGridTable .grid-fixed-column .grid-thead:after {
            display: none;
        }

        .mGridTable .grid-thead {
            background-color: #f0f0f0;
        }

        .mGridTable .grid-thead th {
            background-clip: padding-box;
        }

        .mGridTable .grid-thead:after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            display: inline-block;
            width: 17px;
            height: 100%;
            border-top: 1px solid #bbc0c4;
            border-bottom: 1px solid #bbc0c4;
            box-sizing: border-box;
        }

        /* grid-resize */
        .mGridTable.grid-resize tbody td {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .mGridTable.grid-resize tbody td.contentEllipsis {
            white-space: inherit;
        }

        .mGridTable.grid-resize tbody td.contentEllipsis a {
            display: -webkit-box;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }

        .mGridTable.grid-resize .grid-wrapper.selectNone {
            -ms-user-select: none;
            -moz-user-select: -moz-none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            user-select: none;
        }

        .mGridTable.grid-resize .moveLine {
            position: absolute;
            border-left: 1px dashed #bbc0c4;
            width: 6px;
            margin-left: -3px;
            cursor: col-resize;
            height: 98%;
            top: 0;
            z-index: 20;
        }

        .mGridTable.grid-resize .moveLine.cursorHalf {
            cursor: not-allowed;
        }

        .mGridTable.grid-resize .grid-thead th {
            background-image: url('//img.echosting.cafe24.com/suio/ico_grid_resizer1.gif'), url('//img.echosting.cafe24.com/suio/ico_grid_resizer2.gif');
            background-position: left center, right center;
            background-repeat: no-repeat;
        }

        .mGridTable.grid-resize .grid-thead th:first-child {
            background-image: url('//img.echosting.cafe24.com/suio/ico_grid_resizer2.gif');
            background-position: right center;
        }

        .mGridTable.grid-resize .grid-thead th:last-child {
            background-image: url('//img.echosting.cafe24.com/suio/ico_grid_resizer1.gif');
            background-position: left center;
        }

        .mGridTable.grid-resize .grid-thead th[rowspan] + th[colspan] {
            background-image: url('//img.echosting.cafe24.com/suio/ico_grid_resizer2.gif');
            background-position: right center;
        }

        .mGridTable.grid-resize .grid-thead th[rowspan] + th[colspan]:before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -7px;
            display: inline-block;
            width: 2px;
            height: 13px;
            background: url('//img.echosting.cafe24.com/suio/ico_grid_resizer1.gif');
        }

        .mGridTable.grid-resize .grid-thead tr:nth-of-type(2) th {
            background-image: none;
        }

        .mGridTable.grid-resize .grid-thead .resizer {
            position: absolute;
            display: block;
            right: -8px;
            top: 0;
            bottom: -50%;
            width: 16px;
            max-height: 70px;
            cursor: col-resize;
            z-index: 10;
        }

        .mGridTable.grid-resize .grid-thead th:last-child .resizer {
            display: none;
        }

        .mGridTable.grid-resize .grid-thead .cursorNone {
            cursor: initial;
        }

        .mGridTable.grid-resize .grid-thead .cursorHalf {
            cursor: url('//img.echosting.cafe24.com/suio/cursor_half.png'), url('//img.echosting.cafe24.com/suio/cursor_half.ani'), auto;
        }

        /* grid-resize-space */
        .mGridTable.grid-resize.grid-resize-space .grid-thead th:last-child .resizer {
            display: block;
        }

        .mGridTable.grid-resize.grid-resize-space .grid-thead th:last-child {
            background-image: url('//img.echosting.cafe24.com/suio/ico_grid_resizer1.gif'), url('//img.echosting.cafe24.com/suio/ico_grid_resizer2.gif');
            background-position: left center, right center;
        }

        .mGridTable.grid-resize.grid-resize-space .grid-background {
            position: absolute;
            width: 0;
            height: 0;
            right: 0;
            top: 0;
            background-color: #bcc0c3;
        }

        /* sort */
        .mGridTable .array {
            position: relative;
            background-clip: padding-box;
            cursor: pointer;
        }

        .mGridTable .array:hover {
            color: #1c1c1c;
            text-decoration: underline;
        }

        .mGridTable .array.descend,
        .mGridTable .array.ascend {
            color: #1b87d4;
        }

        .mGridTable .array > button {
            display: block;
            overflow: hidden;
            width: 0;
            height: 0;
            white-space: nowrap;
            text-indent: 150%;
            font-size: 0;
            line-height: 0;
        }

        .mGridTable .array.tip .text {
            padding: 0 30px 0 7px;
        }

        .mGridTable .array.tip .mTooltip {
            position: absolute;
            top: 50%;
            right: 20px;
            margin-top: -6px;
        }

        .mGridTable .array .text {
            position: relative;
            display: block;
            padding: 0 7px;
        }

        .mGridTable .array .text:after {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            width: 7px;
            height: 4px;
            margin-top: -2px;
            background: url("//img.echosting.cafe24.com/suio/sfix_btn.png") no-repeat 0 -21px;
        }

        .mGridTable .array:hover .text:after {
            background-position: -17px -21px;
        }

        .mGridTable .array.ascending .text:after {
            background-position: 0 -49px;
        }

        .mGridTable .array.ascending:hover .text:after {
            background-position: -17px -49px;
        }

        .mGridTable .array.descend .text:after {
            background-position: 0 -35px;
        }

        .mGridTable .array.ascend .text:after {
            background-position: -17px -35px;
        }

        /* align */
        .mGridTable .left {
            text-align: left;
        }

        .mGridTable .center {
            text-align: center;
        }

        .mGridTable .right {
            text-align: right;
        }

        .mGridTable .middle, .mGridTable .middle th, .mGridTable .middle td {
            vertical-align: middle;
        }

        .mGridTable .top, .mGridTable .middle .top {
            vertical-align: top;
        }

        .mGridTable thead th .mTooltip {
            margin-left: 4px;
        }

        /* color */
        .mGridTable tbody .negative {
            background-color: #feeef0 !important;
        }

        .mGridTable tbody tr.positive,
        .mGridTable tbody td.positive,
        .mGridTable tfoot td.positive {
            background-color: #fff5d8 !important;
        }

        .mGridTable tbody tr.bgDivision {
            background-color: #ebfbf4 !important;
        }

        .mGridTable tbody tr.selected,
        .mGridTable tbody td.selected {
            background-color: #f4f9ff !important;
        }

        /* padding */
        .mGridTable.gCell td {
            padding: 5px 4px 4px;
        }

        .mGridTable.gCellSingle td {
            padding-top: 5px;
            padding-bottom: 4px;
        }

        .mGridTable.gCellNarrow td {
            padding-left: 4px;
            padding-right: 4px;
        }

        /* 설정 팝업 */
        .mCtrl.setting .gSetting .btnSetMenu {
            display: block;
            height: 100%;
            border-left: 1px solid #bbc0c4;
            overflow: hidden;
        }

        .mCtrl.setting .gSetting .btnSetMenu span {
            position: relative;
            top: 9px;
            overflow: hidden;
            display: block;
            width: 16px;
            height: 17px;
            margin: 0 auto;
            text-indent: 150%;
            white-space: nowrap;
            background: url('//img.echosting.cafe24.com/ec/v2/ko_KR/sfix_icon_button2.png') no-repeat -200px -500px;
        }

        /* mGoods */
        .mGridTable .mGoods {
            margin: -5px 0 0;
        }

        .mGridTable .mGoods .check {
            float: left;
            padding: 15px 0 0;
        }

        .mGridTable .mGoods .gGoods {
            margin: 5px 0 0;
        }

        .mGridTable .gGoods {
            position: relative;
            text-align: left;
        }

        .mGridTable .gGoods:after {
            content: "";
            display: block;
            clear: both;
        }

        .mGridTable .gGoods .frame {
            float: left;
            margin: 0 0 2px;
        }

        .mGridTable .gGoods .option,
        .mGridTable .gGoods .option a {
            margin: 2px 0 0;
            color: #898989;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 14px;
        }

        .mGridTable .gGoods .etc,
        .mGridTable .gGoods .etc a {
            margin: 2px 0 0;
            color: #1b87d4;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 14px;
        }

        .mGridTable .gGoods .set,
        .mGridTable .gGoods .set a {
            margin: 2px 0 0;
            color: #1b87d4;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 14px;
        }

        .mGridTable .gGoods li {
            padding: 0 0 0 9px;
            margin: 0;
            background: url("//img.echosting.cafe24.com/suio/sflex_ico.png") no-repeat -395px -194px;
        }

        .mGridTable .gGoods .set li {
            margin: 0;
            padding-left: 0;
            background: none;
        }

        .mGridTable .gGoods .set li li {
            padding: 0 0 0 9px;
            background: url("//img.echosting.cafe24.com/suio/sflex_ico.png") no-repeat -395px -194px;
        }

        .mGridTable .gGoods .set li ul {
            margin: 0 0 0 10px;
            padding: 0 0 3px;
        }

        .mGridTable .gGoods.gSmall p,
        .mGridTable .gGoods.gSmall ul {
            padding: 0 0 0 44px;
        }

        .mGridTable .gGoods.gMedium p,
        .mGridTable .gGoods.gMedium ul {
            padding: 0 0 0 59px;
        }

        .mGridTable .gGoods.gMedium ul ul {
            padding: 0 0 3px;
        }

        .mGridTable .gGoods.gCheck .fChk {
            float: left;
            margin: 0 3px 0 0;
        }

        .mGridTable .gGoods.gSmall.gCheck p {
            padding: 0 0 0 61px;
        }

        .mGridTable .gGoods.gSmall.gCheck ul {
            padding: 0 0 0 59px;
        }

        .mGridTable .gGoods.gSmall.gCheck ul ul {
            padding: 0 0 3px;
        }

        .mGridTable .gGoods.gMedium.gCheck p,
        .mGridTable .gGoods.gMedium.gCheck ul {
            padding: 0 0 0 76px;
        }

        .mGridTable .gGoods.gMedium.gCheck ul ul {
            padding: 0 0 3px;
        }

        .mGridTable .gGoods.gFunction {
            padding: 0 30px 0 0;
        }

        .mGridTable .gGoods.gFunction .icoView {
            position: absolute;
            top: 0;
            right: 0;
        }

        /* ----------------------------------------- //mSearchEngine & mGridTable ----------------------------------------- */

        /* ----------------------------------------- Module  ----------------------------------------- */

        /* mTab */
        .mTab {
            position: relative;
            zoom: 1;
            margin: 0 0 8px;
        }

        /* mTab + typeNav */
        .mTab.typeNav {
            margin: 0 0 16px;
            background-color: #fafafd;
        }

        .mTab.typeNav > ul {
            position: relative;
            height: 44px;
            border: 1px solid #d6dae1;
        }

        .mTab.typeNav > ul:after {
            content: "";
            display: block;
            clear: both;
        }

        .mTab.typeNav > ul > li {
            border-right: 1px solid #d6dae1;
            box-sizing: border-box;
        }

        .mTab.typeNav > ul > li:first-child {
            margin-left: 0;
        }

        .mTab.typeNav > ul > li > .btnPlus {
            position: relative;
            height: 45px;
            width: 45px;
            overflow: hidden;
            white-space: nowrap;
            text-indent: 150%;
        }

        .mTab.typeNav > ul > li > .btnPlus:after {
            content: '추가';
            position: absolute;
            top: 50%;
            left: 50%;
            height: 14px;
            width: 14px;
            margin: -7px 0 0 -7px;
            overflow: hidden;
            font-size: 1px;
            color: transparent;
            line-height: 0;
            white-space: nowrap;
            background: url("//img.echosting.cafe24.com/ec/v2/sfix_tab_icon.png") -100px 0 no-repeat;
        }

        .mTab.typeNav > ul > li > .btnPlus:hover:after {
            background-position: -150px 0;
        }

        html:lang(ja) .mTab.typeNav > ul > li > .btnPlus:after {
            content: '追加';
        }

        html:lang(vi) .mTab.typeNav > ul > li > .btnPlus:after {
            content: 'Thêm';
        }

        html:lang(en) .mTab.typeNav > ul > li > .btnPlus:after {
            content: 'Add';
        }

        .mTab.typeNav > ul > li,
        .mTab.typeNav > ul > li > ul > li {
            float: left;
        }

        .mTab.typeNav > ul > li a {
            position: relative;
            display: inline-block;
            min-width: 45px;
            padding: 12px 15px 13px;
            box-sizing: border-box;
            font-size: 13px;
            color: #667084;
            text-align: center;
            line-height: 1.5;
            text-decoration: none;
            vertical-align: top;
        }

        html:lang(ja) .mTab.typeNav > ul > li a {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mTab.typeNav > ul > li a {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mTab.typeNav > ul > li a {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mTab.typeNav > ul > li > .delete {
            position: relative;
            display: inline-block;
            width: 28px;
            height: 45px;
            overflow: hidden;
            white-space: nowrap;
            text-indent: 150%;
        }

        .mTab.typeNav > ul > li a + .delete {
            margin: 0 0 0 -15px;
            vertical-align: top;
        }

        .mTab.typeNav > ul > li > .delete:after {
            content: '삭제';
            position: absolute;
            left: 50%;
            top: 50%;
            width: 8px;
            height: 8px;
            margin: -4px 0 0 -4px;
            overflow: hidden;
            font-size: 1px;
            line-height: 0;
            color: transparent;
            text-indent: -150%;
            white-space: nowrap;
            background: url("//img.echosting.cafe24.com/ec/v2/sfix_tab_icon.png") 0 0 no-repeat;
        }

        html:lang(ja) .mTab.typeNav > ul > li > .delete:after {
            content: '削除';
        }

        html:lang(vi) .mTab.typeNav > ul > li > .delete:after {
            content: 'Xóa';
        }

        html:lang(en) .mTab.typeNav > ul > li > .delete:after {
            content: 'Delete';
        }

        .mTab.typeNav > ul > li > .delete:hover:after {
            background-position: -50px 0;
        }

        .mTab.typeNav > ul > li.selected {
            border-top: 2px solid #3971ff;
            background-color: #fff;
            margin: -1px 0 0 0;
        }

        .mTab.typeNav > ul > li.selected a {
            color: #3971ff;
            padding: 11px 15px 13px;
            font-weight: bold;
            height: 43px;
        }

        .mTab.typeNav > ul > li.selected a + .delete {
            height: 42px;
        }

        /* 확장 */
        .mTab.typeNav > ul > li > ul {
            display: none;
        }

        .mTab.typeNav.gExtend {
            height: 88px;
            background: none;
        }

        .mTab.typeNav.gExtend > ul {
            display: block;
            background-color: #fafafd;
        }

        .mTab.typeNav.gExtend > ul > li > ul {
            display: none;
            position: absolute;
            left: 0;
            top: 100%;
            overflow: hidden;
            width: 100%;
            height: auto;
            padding: 13px 4px;
        }

        .mTab.typeNav.gExtend > ul > li.selected > ul {
            display: block;
        }

        .mTab.typeNav.gExtend > ul > li > ul > li {
            position: relative;
            margin-left: -1px;
            height: 18px;
            padding: 0 12px;
        }

        .mTab.typeNav.gExtend > ul > li > ul > li a {
            position: static;
            min-width: auto;
            height: auto;
            padding: 0;
            font-size: 12px;
            color: #1b1e26;
            line-height: 18px;
            font-weight: normal;
        }

        html:lang(ko) .mTab.typeNav.gExtend > ul > li > ul > li a {
            font-size: 13px;
        }

        .mTab.typeNav.gExtend > ul > li > ul > li a:before {
            content: '';
            position: absolute;
            left: 0;
            top: 7px;
            width: 1px;
            height: 7px;
            background-color: #d6dae1;
        }

        .mTab.typeNav.gExtend > ul > li > ul > li:first-child a:before {
            display: none;
        }

        .mTab.typeNav.gExtend > ul > li > ul > li.selected a {
            color: #3971ff;
        }

        /* mTab + typeTab */
        .mTab.typeTab > ul {
            position: relative;
            height: 44px;
            border-bottom: 1px solid #d6dae1;
        }

        .mTab.typeTab > ul:after {
            content: "";
            display: block;
            clear: both;
        }

        .mTab.typeTab > ul > li {
            margin: 0 12px;
        }

        .mTab.typeTab > ul > li > .btnPlus {
            position: relative;
            height: 28px;
            width: 28px;
            margin: 8px 0 0;
            border-radius: 3px;
            overflow: hidden;
            white-space: nowrap;
            text-indent: 150%;
            background-color: #e2e5ea;
        }

        .mTab.typeTab > ul > li > .btnPlus:after {
            content: "추가";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            margin: -5px 0 0 -5px;
            overflow: hidden;
            font-size: 1px;
            line-height: 0;
            color: transparent;
            white-space: nowrap;
            background: url("//img.echosting.cafe24.com/ec/v2/sfix_tab_icon.png") -100px -50px no-repeat;
        }

        .mTab.typeTab > ul > li > .btnPlus:hover:after {
            background-position: -150px -50px;
        }

        html:lang(ja) .mTab.typeTab > ul > li > .btnPlus:after {
            content: '追加';
        }

        html:lang(vi) .mTab.typeTab > ul > li > .btnPlus:after {
            content: 'Thêm';
        }

        html:lang(en) .mTab.typeTab > ul > li > .btnPlus:after {
            content: 'Add';
        }

        .mTab.typeTab > ul > li,
        .mTab.typeTab > ul > li > ul > li {
            float: left;
        }

        .mTab.typeTab > ul > li a,
            /* 참고: 개발 구조에 대응하는 css입니다 */
        .mTab.typeTab > ul > li .tabName {
            float: left;
            min-width: 40px;
            padding: 13px 2px 12px;
            font-size: 12px;
            line-height: 20px;
            color: #1b1e26;
            text-align: center;
            text-decoration: none;
        }

        html:lang(ko) .mTab.typeTab > ul > li a,
        html:lang(ko) .mTab.typeTab > ul > li .tabName {
            font-size: 13px;
        }

        .mTab.typeTab > ul > li .tabName {
            cursor: pointer;
        }

        /* //참고 */

        .mTab.typeTab > ul > li > .delete {
            position: relative;
            float: left;
            width: 27px;
            height: 45px;
            overflow: hidden;
            white-space: nowrap;
            text-indent: 150%;
        }

        .mTab.typeTab > ul > li a + .delete {
            margin: 0 0 0 -2px;
        }

        .mTab.typeTab > ul > li > .delete:after {
            content: '삭제';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 8px;
            height: 8px;
            margin: -4px 0 0 -4px;
            overflow: hidden;
            font-size: 1px;
            color: transparent;
            white-space: nowrap;
            background: url("//img.echosting.cafe24.com/ec/v2/sfix_tab_icon.png") 0 -50px no-repeat;
        }

        html:lang(ja) .mTab.typeTab > ul > li > .delete:after {
            content: '削除';
        }

        html:lang(vi) .mTab.typeTab > ul > li > .delete:after {
            content: 'Xóa';
        }

        html:lang(en) .mTab.typeTab > ul > li > .delete:after {
            content: 'Delete';
        }

        .mTab.typeTab > ul > li > .delete:hover:after {
            background-position: -50px -50px;
        }

        .mTab.typeTab > ul > li.selected {
            background: none;
            border-bottom: 2px solid #3971ff;
            margin: -2px 12px 0;
        }

        .mTab.typeTab > ul > li:first-child,
        .mTab.typeTab > ul > li:first-child.selected {
            margin-left: 0;
        }

        .mTab.typeTab > ul > li.selected > a,
        .mTab.typeTab > ul > li.selected > .tabName {
            font-weight: bold;
            color: #3971ff;
            padding: 15px 2px 10px;
        }

        /* 참고: 개발 구조에 대응하는 css입니다 */
        .mTab.typeTab > ul > li.important {
            border-bottom: 2px solid #f52247;
            margin: -2px 12px 0;
        }

        .mTab.typeTab > ul > li.important a {
            color: #f52247;
            font-weight: bold;
            padding: 15px 2px 10px;
        }

        .mTab.typeTab > ul > li.important.selected a {
            color: #1c1c1c;
            border-color: #1c1c1c;
            background-color: #fff;
        }

        /* 확장 */
        .mTab.typeTab > ul > li > ul {
            display: none;
        }

        .mTab.typeTab.gExtend {
            height: 88px;
        }

        .mTab.typeTab.gExtend > ul > li > ul {
            display: none;
            position: absolute;
            left: 0;
            top: 100%;
            overflow: hidden;
            width: 100%;
            height: auto;
            padding: 13px 4px;
        }

        .mTab.typeTab.gExtend > ul > li.selected > ul {
            display: block;
        }

        .mTab.typeTab.gExtend > ul > li > ul > li {
            position: relative;
            height: 18px;
            padding: 0 12px;
        }

        .mTab.typeTab.gExtend > ul > li > ul > li a {
            position: static;
            min-width: auto;
            height: auto;
            padding: 0;
            font-size: 12px;
            color: #1b1e26;
            line-height: 18px;
        }

        html:lang(ko) .mTab.typeTab.gExtend > ul > li > ul > li a {
            font-size: 13px;
        }

        .mTab.typeTab.gExtend > ul > li > ul > li a:before {
            content: '';
            position: absolute;
            left: 0;
            top: 7px;
            width: 1px;
            height: 7px;
            background-color: #d6dae1;
        }

        .mTab.typeTab.gExtend > ul > li > ul > li:first-child a:before {
            display: none;
        }

        .mTab.typeTab.gExtend > ul > li > ul > li.selected a {
            color: #3971ff;
        }

        /* mTab > gRight */
        .mTab > .gRight {
            position: absolute;
            top: 0;
            right: 10px;
            box-sizing: border-box;
        }

        .mTab.typeNav > .gRight {
            height: 42px;
            line-height: 24px;
            padding: 9px 0 0;
        }

        .mTab.typeTab > .gRight {
            height: 32px;
            line-height: 21px;
            padding: 6px 0 0;
        }

        /* mTab + typeOption */
        .mTab.typeOption ul {
            padding: 0 0 0 1px;
            zoom: 1;
        }

        .mTab.typeOption ul:after {
            content: "";
            display: block;
            clear: both;
        }

        .mTab.typeOption li {
            float: left;
            position: relative;
        }

        .mTab.typeOption li a {
            display: block;
            margin-left: -1px;
            padding: 12px 30px 11px;
            border: 1px solid #ccc;
            font-weight: bold;
            font-size: 14px;
            color: #80878d;
            background: #e9eff5;
        }

        .mTab.typeOption li a:hover {
            text-decoration: none;
        }

        .mTab.typeOption li:before {
            display: none;
            content: "";
            display: none;
            position: absolute;
            bottom: -6px;
            left: 50%;
            width: 0;
            height: 0;
            margin: 0 0 0 -6px;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 7px solid #4685c3;
        }

        .mTab.typeOption li:after {
            display: none;
            content: "";
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 0;
            margin: 0 0 0 -5px;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #579ee5;
        }

        .mTab.typeOption .selected:before,
        .mTab.typeOption .selected:after {
            display: block;
        }

        .mTab.typeOption .selected {
            z-index: 1;
        }

        .mTab.typeOption .selected a {
            border: 1px solid #4d92d6;
            color: #fff;
            text-shadow: 1px 1px #3076d9;
            background: #579ee5;
        }

        /* gFull */
        .mTab.typeOption.gFull ul {
            display: table;
            width: 100%;
            table-layout: fixed;
            table-layout: auto \9;
        }

        .mTab.typeOption.gFull li {
            display: table-cell;
            float: none;
            width: 100%;
            text-align: center;
            *float: left;
            width: auto \9;
        }

        /* bg common */
        .mTab.typeOption[class*="item"] a:before {
            content: "";
            display: inline-block;
            width: 16px;
            height: 17px;
            margin: 0 8px 0 0;
            vertical-align: -2px;
            background-repeat: no-repeat;
        }

        /* mTab gPaginate */
        .mTab.gPaginate {
            position: relative;
            overflow: hidden;
            width: 100%;
            box-sizing: border-box;
            height: 46px;
        }

        .mTab.gPaginate button:disabled {
            cursor: auto;
        }

        .mTab.gPaginate .btnPrev,
        .mTab.gPaginate .btnNext {
            position: absolute;
            top: 0;
            width: 20px;
            height: 100%;
            border-width: 1px;
            border-style: solid;
            border-color: #d6dae1;
            outline: none;
            text-indent: -9999px;
        }

        .mTab.gPaginate .btnPrev {
            left: 0;
        }

        .mTab.gPaginate .btnNext {
            right: 0;
        }

        .mTab.gPaginate .btnPrev:after,
        .mTab.gPaginate .btnNext:after {
            content: "";
            position: absolute;
            background: url("//img.echosting.cafe24.com/ec/v2/sfix_tab_icon.png")
        }

        .mTab.gPaginate > ul {
            z-index: 1;
            margin: 0 -1px 0 -1px;
        }

        .mTab.gPaginate > ul > li {
            position: relative;
        }

        .mTab.gPaginate > ul > li a {
            overflow: hidden;
            width: 100%;
            min-width: auto;
            text-overflow: ellipsis;
            white-space: nowrap;
            box-sizing: border-box;
        }

        .mTab.gPaginate > ul > li a + .delete {
        }

        /* grid */
        .mTab.gPaginate.grid10 > ul > li {
            width: 10%;
        }

        .mTab.gPaginate.grid5 > ul > li {
            width: 20%;
        }

        /* typeNav */
        .mTab.gPaginate.typeNav {
            padding: 0 46px;
        }

        .mTab.gPaginate.typeNav ul {
            border-right: 0;
        }

        .mTab.gPaginate.typeNav .btnPrev,
        .mTab.gPaginate.typeNav .btnNext {
            width: 46px;
            height: 46px;
        }

        .mTab.gPaginate.typeNav .btnPrev:after,
        .mTab.gPaginate.typeNav .btnNext:after {
            top: 15px;
            left: 18px;
            width: 8px;
            height: 14px;
        }

        .mTab.gPaginate.typeNav .btnPrev:after {
            background-position: -300px 0;
        }

        .mTab.gPaginate.typeNav .btnNext:after {
            background-position: -350px 0;
        }

        .mTab.gPaginate.typeNav .btnPrev:disabled:after {
            background-position: -200px 0;
        }

        .mTab.gPaginate.typeNav .btnNext:disabled:after {
            background-position: -250px 0;
        }

        /* typeTab */
        .mTab.gPaginate.typeTab {
            height: 45px;
        }

        .mTab.gPaginate.typeTab > ul {
            padding: 0 44px;
            margin: 0;
        }

        .mTab.gPaginate.typeTab > ul > li {
            margin: 0;
        }

        .mTab.gPaginate.typeTab > ul > li a {
            padding: 13px 8px 12px
        }

        .mTab.gPaginate.typeTab > ul > li.selected > a {
            padding: 13px 8px 10px;
        }

        .mTab.gPaginate.typeTab .btnPrev,
        .mTab.gPaginate.typeTab .btnNext {
            top: 8px;
            z-index: 2;
            width: 28px;
            height: 28px;
            border-bottom: 1px solid #d6dae1;
            border-radius: 3px;
            background-color: #e2e5ea;
        }

        .mTab.gPaginate.typeTab .btnPrev:after,
        .mTab.gPaginate.typeTab .btnNext:after {
            top: 10px;
            left: 12px;
            width: 5px;
            height: 8px;
        }

        .mTab.gPaginate.typeTab .btnPrev:after {
            background-position: -300px -50px;
        }

        .mTab.gPaginate.typeTab .btnNext:after {
            background-position: -350px -50px;
        }

        .mTab.gPaginate.typeTab .btnPrev:disabled:after {
            background-position: -200px -50px;
        }

        .mTab.gPaginate.typeTab .btnNext:disabled:after {
            background-position: -250px -50px;
        }

        /* mToggle */
        .toggleArea {
            display: none;
        }

        .mToggle {
            position: relative;
            height: 3px;
            font-size: 0;
            line-height: 0;
            border: 1px solid #d9dadc;
            background-color: #ececec;
        }

        .mToggle .gLabel {
            font-size: 12px;
            line-height: 1.5;
        }

        html:lang(ko) .mToggle .gLabel {
            font-size: 13px;
        }

        .mToggle .gLabel input {
            vertical-align: -2px;
        }

        .mToggle .ctrl span,
        .mToggle .ctrl span button {
            display: inline-block;
            position: relative;
            overflow: visible;
            height: 25px;
            margin: 0;
            padding: 0;
            border: 0;
            line-height: 26px;
            vertical-align: top;
            white-space: nowrap;
            background-image: url("//img.echosting.cafe24.com/suio/sflex_toggle_bg.png");
        }

        .mToggle .ctrl span {
            margin-right: 2px;
            background-position: 0 0;
        }

        .mToggle .ctrl span button {
            left: 2px;
            padding: 0 25px 0 14px;
            font-size: 12px;
            font-weight: bold;
            background-position: 100% 0;
        }

        html:lang(ko) .mToggle .ctrl span button {
            font-size: 13px;
        }

        .mToggle .ctrl span button em {
            font-style: normal;
        }

        .mToggle.typeHeader {
            margin: 8px 0 0;
        }

        .mToggle.typeHeader .ctrl {
            position: absolute;
            right: -1px;
            top: -25px;
        }

        .mToggle.typeHeader + .toggleArea .mBoard {
            margin-top: -1px;
        }

        .mToggle.typeHeader .ctrl span:hover {
            background-position: 0 -70px;
        }

        .mToggle.typeHeader .ctrl span:hover button {
            color: #1b87d4;
            background-position: 100% -70px;
        }

        .mToggle.typeHeader .ctrl span.selected {
            background-position: 0 -35px;
        }

        .mToggle.typeHeader .ctrl span.selected button {
            background-position: 100% -35px;
        }

        .mToggle.typeHeader .ctrl span.selected:hover {
            background-position: 0 -105px;
        }

        .mToggle.typeHeader .ctrl span.selected:hover button {
            background-position: 100% -105px;
        }

        .mToggle.typeFooter {
            margin: -1px 0 24px;
        }

        .mToggle.typeFooter .ctrl {
            position: absolute;
            right: -1px;
            top: 3px;
        }

        .mToggle.typeFooter .ctrl span {
            background-position: 0 -210px;
        }

        .mToggle.typeFooter .ctrl span button {
            background-position: 100% -210px;
        }

        .mToggle.typeFooter .ctrl span:hover {
            background-position: 0 -280px;
        }

        .mToggle.typeFooter .ctrl span:hover button {
            color: #1b87d4;
            background-position: 100% -280px;
        }

        .mToggle.typeFooter .ctrl span.selected {
            background-position: 0 -245px;
        }

        .mToggle.typeFooter .ctrl span.selected button {
            background-position: 100% -245px;
        }

        .mToggle.typeFooter .ctrl span.selected:hover {
            background-position: 0 -315px;
        }

        .mToggle.typeFooter .ctrl span.selected:hover button {
            background-position: 100% -315px;
        }

        /* mProgress */
        .mProgress {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 110;
            width: 318px;
            height: 70px;
            margin: -49px 0 0 -194px;
            padding: 28px 0 0 70px;
            color: #4c5255;
            background: url("//img.echosting.cafe24.com/suio/sfix_progress.png") no-repeat 0 0;
        }

        .mProgress.typeComplete {
            background-position: 0 -108px;
        }

        .mProgress p {
            position: relative;
            width: 290px;
            margin: 0 0 3px;
        }

        .mProgress p > span {
            position: absolute;
            top: 0;
            right: 0;
            color: #4195e1;
            font-family: verdana, sans-serif;
            font-size: 11px;
            letter-spacing: 0;
        }

        html:lang(ja) .mProgress p > span {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mProgress p > span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mProgress p > span {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mProgress p em {
            font-style: normal;
            font-weight: bold;
            font-size: 12px;
        }

        html:lang(ko) .mProgress p em {
            font-size: 13px;
        }

        .mProgress .bar {
            position: relative;
            width: 290px;
            height: 22px;
            background: url("//img.echosting.cafe24.com/suio/sfix_progress.png") no-repeat 0 -216px;
        }

        .mProgress .bar span {
            position: absolute;
            top: 0;
            left: 0;
            height: 22px;
            background: url("//img.echosting.cafe24.com/suio/sfix_progress.png") no-repeat 0 -248px;
        }

        /* mBanner.typeCommon */
        .mAdvertise {
            overflow: hidden;
            margin: 50px 0;
        }

        .mAdvertise .gFlow,
        .mAdvertise .gReverse {
            width: 49.5%;
        }

        .mAdvertise .gFlow {
            float: left;
        }

        .mAdvertise .gReverse {
            float: right;
        }

        .mAdvertise p {
            min-height: 50px;
            display: inline-block;
            text-align: left;
            background-image: url("//img.echosting.cafe24.com/ec/optional/sflex_intro_buying.gif");
            background-repeat: no-repeat;
        }

        .mAdvertise .qna,
        .mAdvertise .use {
            padding: 19px 0 13px;
            border: 1px solid #e7e7e7;
            text-align: center;
            background: #f2f2f2;
        }

        .mAdvertise .qna p {
            padding: 0 0 0 73px;
            background-position: 0 0;
        }

        .mAdvertise .qna strong {
            display: block;
            margin: 0 0 9px;
        }

        .mAdvertise .use p {
            padding: 0 0 0 65px;
            background-position: -100px -100px;
        }

        /* mPromotion */
        .mPromotion {
            position: relative;
            margin: 30px 0;
            text-align: center;
        }

        .mPromotion a {
            display: block;
        }

        .mPromotion [id*="admngSide"] a {
            position: relative;
            background: #f2f2f2;
        }

        .mPromotion [id*="admngSide"] a:after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            border: 1px solid #e6e7e6;
            box-sizing: border-box;
        }

        .mPromotion ul {
            overflow: hidden;
            width: 786px;
            height: 85px;
            margin: 0 auto;
        }

        .mPromotion .gPaginate {
            position: absolute;
            right: 20px;
            bottom: 9px;
        }

        .mPromotion .gPaginate button {
            overflow: hidden;
            float: left;
            width: 11px;
            height: 11px;
            margin: 0 0 0 4px;
            text-indent: 150%;
            white-space: nowrap;
            background: url("//img.echosting.cafe24.com/suio/sfix_btn.png") no-repeat -22px 0;
        }

        .mPromotion .gPaginate button:hover,
        .mPromotion .gPaginate button.selected {
            background-position: -43px 0;
        }

        .mPromotion.typeFlying {
            position: absolute;
            top: 190px;
            left: 1249px;
            min-height: 0;
            margin: 0;
            text-align: left;
        }

        .mPromotion.typeFlying img {
            display: block;
            margin: 0 0 5px;
        }

        .mPromotion.typePath {
            float: right;
            min-height: 0;
            margin-top: 5px;
        }

        /* mPromotion Reset */
        .gMargin .mPromotion.typeFlying {
            top: 95px;
            left: 1040px;
        }

        /* mOption (공통 : 검색) */
        .optionArea {
            margin: 0 0 16px;
            clear: both;
        }

        .optionArea .mSearchSelect .list {
            overflow: auto;
        }

        .mOption table {
            line-height: 18px;
            background-color: #fff;
        }

        .mOption th,
        .mOption td {
            height: 28px;
            padding: 8px;
            border: 1px solid #d9dadc;
            text-align: left;
        }

        .mOption th {
            font-weight: normal;
            vertical-align: middle;
            background-color: #fafafb;
        }

        .mOption.gDivision {
            display: none;
            margin: -1px 0 0;
        }

        .mOption.gDivision tr:first-child th,
        .mOption.gDivision tr:first-child td {
            border-top: 1px solid #d9dadc;
        }

        .mOption.gDivision tr:first-child .mBoard td {
            border-top: 0;
        }

        .mOptionToogle {
            position: relative;
            margin: 0 0 42px;
        }

        .mOptionToogle .ctrl {
            position: absolute;
            top: 5px;
            right: 0;
        }

        .mOptionToogle .ctrl span button {
            position: relative;
            height: 25px;
            padding: 0 20px 0 0;
            font-size: 13px;
            line-height: 25px;
            font-weight: bold;
        }

        .mOptionToogle .ctrl span button:after {
            content: "";
            position: absolute;
            top: 6px;
            right: 4px;
            width: 6px;
            height: 6px;
            border-width: 0 2px 2px 0;
            border-style: solid;
            border-color: #444b59;
            border-radius: 2px;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .mOptionToogle .ctrl span.selected button:after {
            top: 11px;
            -webkit-transform: rotate(225deg);
            -moz-transform: rotate(225deg);
            -ms-transform: rotate(225deg);
            transform: rotate(225deg);
        }

        .mSearchSelect thead th {
            height: 28px;
            padding: 8px;
            border: 1px solid #d9dadc;
            font-weight: normal;
            text-align: left;
            vertical-align: middle;
            background-color: #fafafb;
        }

        .mSearchSelect thead .gLabel {
            float: left;
        }

        .mSearchSelect thead .btnNormal,
        .mSearchSelect .list strong.title .btnNormal {
            float: right;
            margin: -2px 0 0;
        }

        .mSearchSelect tbody td {
            padding: 0;
            border: 1px solid #d9dadc;
            vertical-align: top;
        }

        .mSearchSelect .list {
            overflow: auto;
            height: 200px;
        }

        .mSearchSelect .list strong.title {
            display: block;
            padding: 5px 14px 5px 10px;
            border-top: 1px solid #bbc0c4;
            border-bottom: 1px solid #bbc0c4;
            color: #80878d;
            font-weight: normal;
            background: #f5f4f4;
        }

        .mSearchSelect .list strong.title:first-child {
            border-top: 0;
        }

        .mSearchSelect .list ul {
            padding: 8px 8px 7px;
        }

        .mSearchSelect .list li {
            padding: 4px 0 0;
        }

        .mSearchSelect .list li.line {
            margin: 2px 0 0;
            border-top: 1px solid #c6c6d0;
        }

        .mSearchSelect .list .inner {
            display: table;
            width: 100%;
        }

        .mSearchSelect .list .inner .title {
            display: table-cell;
            width: 25%;
            border-right: 1px solid #bbc0c4;
        }

        .mSearchSelect .list .inner .gForm {
            display: table-cell;
            width: 75%;
            padding: 5px;
            font-size: 11px;
            letter-spacing: 0;
            border-bottom: 1px solid #bbc0c4;
        }

        .mSearchSelect .list .inner .gForm .label {
            display: inline-block;
        }

        .mSearchSelect button {
            position: relative;
            z-index: 1;
            display: block;
            width: 100%;
            margin: -1px 0 0;
            border: 1px solid #bbc0c4;
            color: #80878d;
            font-size: 11px;
            letter-spacing: 0;
            text-align: center;
            line-height: 20px;
            background: #f5f4f4;
        }

        .mSearchSelect button span {
            padding: 0 17px 0 0;
            background: url("//img.echosting.cafe24.com/suio/sflex_ico_option.png") no-repeat 65px 3px;
        }

        html:lang(vi) .mSearchSelect button span {
            background-position: 75px 3px;
        }

        .mSearchSelect button.selected {
            background-color: #f5f4f4;
        }

        .mSearchSelect button.selected span {
            background-position: 15px -97px;
        }

        html:lang(vi) .mSearchSelect button.selected span {
            background-position: 35px -97px;
        }

        .mSearchSelect .mTooltip {
            margin-top: 3px;
        }

        .mSearchSelect .mTooltip.gLabel {
            margin: 4px 5px 0 0;
        }

        .mSearchSelect .mTooltip button {
            border: 0;
        }

        /* mSearchSelect + theme1 */
        .mSearchSelect.theme1 table {
            border-right: 1px solid #d9dadc;
            border-bottom: 1px solid #d9dadc;
        }

        .mSearchSelect.theme1 .state {
            min-height: 0;
            margin-top: 8px;
            padding: 10px 16px;
            border: 1px solid #d9dadc;
            color: #667084;
            line-height: 18px;
            background-color: #fafafb;
        }

        .mSearchSelect.theme1 .state + table {
            margin: -1px 0 0;
        }

        .mSearchSelect.theme1 .empty {
            margin-top: -1px;
            padding: 100px 0;
            border: 1px solid #d9dadc;
            text-align: center;
            background-color: #fff;
        }

        .mSearchSelect.theme1 td {
            vertical-align: middle;
        }

        .mSearchSelect.theme1 td:last-child {
            padding: 17px;
            border: none;
            text-align: center;
        }

        .mSearchSelect.theme1 td.displaynone {
            display: none;
        }

        .mSearchSelect.theme1 td.displaynone + td {
            text-align: left;
        }

        .mSearchSelect.theme1 .list ul {
            padding: 0;
        }

        .mSearchSelect.theme1 .list li {
            position: relative;
            overflow: hidden;
            padding: 12px 32px 12px 16px;
            border-bottom: 1px solid #e2e5ea;
            line-height: 18px;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .mSearchSelect.theme1 .list li .right {
            position: absolute;
            right: 18px;
            top: 12px;
            font-weight: bold;
        }

        .mSearchSelect.typeCategory.theme1 .list li.selected {
            color: #3971ff;
            background: none;
        }

        .mSearchSelect.typeCategory.theme1 .list li:hover {
            background-color: #f4f9ff;
        }

        /* mInsert */
        .mInsert {
            min-height: 46px;
            margin-top: -1px;
            padding: 8px;
            border: 1px solid #d9dadc;
            box-sizing: border-box;
            background-color: #fafafb;
            line-height: 28px;
        }

        .mInsert .fText {
            width: 25px;
            margin-left: 10px;
            padding-right: 3px;
            padding-left: 0;
            color: #0788ca;
            font-family: verdana, sans-serif;
            font-weight: bold;
            text-align: right;
            vertical-align: top;
        }

        .mInsert .btnNormal {
            margin-left: 5px;
            vertical-align: top;
        }

        /* mCtrl */
        .mCtrl {
            min-height: 46px;
            padding: 8px;
            border: 1px solid #d9dadc;
            box-sizing: border-box;
            text-align: center;
            background-color: #fff;
        }

        .mCtrl:after {
            content: "";
            display: block;
            clear: both;
        }

        .mCtrl.typeHeader {
            position: relative;
            z-index: 1;
            margin-bottom: -1px;
        }

        .mCtrl.typeFooter {
            margin: -1px 0 0 0;
        }

        .mCtrl.typeSetting {
            position: relative;
            z-index: 1;
            margin-bottom: -1px;
            background-color: #fafafd;
        }

        .mCtrl.gTable {
            position: static;
        }

        .mCtrl .gLeft {
            float: left;
            text-align: left;
        }

        /* .mCtrl .gLeft > label { margin-left:-5px; } */
        .mCtrl .gLeft > label {
            display: inline-block;
            margin-top: 4px;
        }

        .mCtrl .gLeft + .gLeft {
            padding: 0 0 0 15px;
        }

        .mCtrl .gRight {
            float: right;
            text-align: right;
        }

        .mCtrl .gTop {
            text-align: left;
        }

        .mCtrl .gTop:after {
            content: "";
            display: block;
            clear: both;
        }

        .mCtrl .gBottom {
            margin: 8px 0 0;
            padding: 8px 0 0;
            border-top: 1px solid #d9dadc;
            text-align: right;
        }

        .mCtrl .gBottom:after {
            content: "";
            display: block;
            clear: both;
        }

        /* mCtrl + setting */
        .mCtrl.setting {
            padding-right: 33px;
        }

        .mCtrl.setting .gSetting {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 33px;
        }

        .mCtrl.setting .gSetting .mOpen {
            display: block;
            width: 100%;
            height: 100%;
        }

        .mCtrl.setting .gSetting .mOpen strong {
            display: block;
            padding: 16px 16px 0;
            text-align: left;
        }

        .mCtrl.setting .gSetting .open {
            left: auto;
            right: 100%;
            top: 8px;
            min-width: 200px;
            max-width: 300px;
            margin: 0 -1px 0 0;
        }

        .mCtrl.setting .gSetting .wrap {
            height: 200px;
            padding: 0 16px;
        }

        .mCtrl.setting .gSetting .wrap .default li {
            padding: 9px 0 0;
            white-space: nowrap;
        }

        .mCtrl.setting .gSetting .wrap .default li.line {
            margin: 4px 0 0;
            padding-top: 4px;
            border-top: 1px solid #ebebeb;
        }

        /*.mCtrl.setting .gSetting .btnSetting { display:inline-block; position:relative; padding:26px 0 0; font-size:12px; line-height:18px; color:#667084; text-decoration:none; }
    .mCtrl.setting .gSetting .btnSetting:before { content:""; position:absolute; top:8px; left:50%; width:14px; height:14px; margin:0 0 0 -7px; background:url('//img.echosting.cafe24.com/ec/v2/ko_KR/sfix_icon_button2.png') no-repeat -150px -500px; }*/
        .mCtrl.setting .gSetting .btnSetting {
            display: block;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .mCtrl.setting .gSetting .btnSetting span {
            position: relative;
            top: 9px;
            overflow: hidden;
            display: block;
            width: 18px;
            height: 27px;
            margin: 0 auto;
            text-indent: 150%;
            white-space: nowrap;
            background: url('//img.echosting.cafe24.com/suio/ko_KR/sfix_icon_button2.png') no-repeat -150px -500px;
        }

        html:lang(ja) .mCtrl.setting .gSetting .btnSetting span {
            background-image: url("//img.echosting.cafe24.com/suio/ja_JP/sfix_icon_button.png");
        }

        html:lang(vi) .mCtrl.setting .gSetting .btnSetting span {
            width: 28px;
            background-image: url("//img.echosting.cafe24.com/suio/vi_VN/sfix_icon_button.png");
        }

        html:lang(en) .mCtrl.setting .gSetting .btnSetting span {
            width: 33px;
            background-image: url("//img.echosting.cafe24.com/suio/en_US/sfix_icon_button.png");
        }

        html:lang(zh) .mCtrl.setting .gSetting .btnSetting span {
            width: 33px;
            background-image: url("//img.echosting.cafe24.com/suio/zh_TW/sfix_icon_button.png");
        }

        /* mBoard + mCtrl */
        .mBoard + .mCtrl.typeHeader,
        .mBoard + .mCtrl.typeSetting {
            margin-top: 10px;
        }

        /* mTootip Reset */
        .mCtrl .gRight .mTooltip {
            margin-top: 0;
        }

        /* mState */
        .mState {
            min-height: 46px;
            margin: 8px 0 -1px;
            padding: 8px;
            border: 1px solid #d9dadc;
            box-sizing: border-box;
            background-color: #fff;
        }

        .mState:after {
            content: "";
            display: block;
            clear: both;
        }

        .mState h2.title {
            float: left;
            padding: 0 5px 0 0;
            font-size: 16px;
            font-weight: normal;
        }

        html:lang(ja) .mState h2.title {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mState h2.title {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mState h2.title {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mState .gLeft {
            float: left;
        }

        .mState .gRight {
            float: right;
        }

        .mState .total {
            float: left;
            margin: 6px 8px 0 0;
        }

        html:lang(ja) .mState .total {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mState .total {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mState .total {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mState .total strong {
            color: #3971ff;
        }

        .mState .total strong.txtEm {
            color: #1b87d4;
        }

        .mState .bgColor {
            float: left;
            padding: 0 5px 0 0;
        }

        .mState .bgColor span {
            display: inline-block;
            color: #1c1c1c;
            font-size: 11px;
            letter-spacing: 0;
            padding: 0 15px 0 0;
        }

        .mState .bgColor span span {
            margin: -2px 5px 0 0;
            width: 14px;
            height: 14px;
            padding: 0;
            vertical-align: middle;
        }

        .mState .bgColor .bgFinish span {
            background: #b6ceed;
        }

        .mState .bgColor .bgNostock span {
            background: #ffe3ef;
        }

        .mState .bgColor .bgNosend span {
            background: #f3c095;
        }

        .mState .bgColor .bgDelete span {
            background: #bebebe;
        }

        .mState .bgColor .bgChange span {
            background: #f06e6f;
        }

        .mBoard .mState {
            margin-top: 0;
        }

        .mTitle + .mState.gMerge {
            position: relative;
            z-index: 1;
            float: right;
            margin-top: -45px;
            border: 0;
            background-color: transparent;
        }

        .mState label + select {
            margin-left: 6px;
        }

        .mState label {
            display: inline-block;
        }

        /* typeFooter */
        .mState.typeFooter {
            margin: -1px 0 0;
        }

        .ctrlHeight {
            width: 100%;
            height: 19px;
            border: 1px solid #bcbfc4;
            border-top: 0;
            text-align: center;
            box-sizing: border-box;
            cursor: s-resize;
            background: url("//img.echosting.cafe24.com/suio/bg_ctrl_height.gif") repeat-x 0 0;
        }

        .ctrlHeight span {
            display: inline-block;
            width: 18px;
            height: 10px;
            margin: 4px 0 0;
            font-size: 0;
            line-height: 0;
            vertical-align: top;
            background: url("//img.echosting.cafe24.com/suio/ico_ctrl_height.png") no-repeat;
        }

        /* (신규) 선택 높이 영역 조절 */
        .mResizer {
            width: 100%;
            text-align: center;
            box-sizing: border-box;
            cursor: s-resize;
        }

        .mResizer span {
            display: inline-block;
            font-size: 0;
            line-height: 0;
            vertical-align: top;
        }

        .mResizer.theme1 {
            margin-top: -1px;
            height: 15px;
            border: 1px solid #d9dadc;
            background: #fafafb;
        }

        .mResizer.theme1 span {
            width: 10px;
            height: 6px;
            margin: 4px 0 0;
            background: url("//img.echosting.cafe24.com/ec/v2/sfix_resizer.png") no-repeat 0 0;
        }

        .mResizer.theme2 {
            height: 19px;
            border: 1px solid #bcbfc4;
            border-top: 0;
            background: url("//img.echosting.cafe24.com/suio/sfix_resizer.png") repeat-x 0 -50px;
        }

        .mResizer.theme2 span {
            width: 18px;
            height: 10px;
            margin: 4px 0 0;
            background: url("//img.echosting.cafe24.com/suio/sfix_resizer.png") no-repeat 0 -25px;
        }

        .mResizer.theme3 {
            height: 28px;
            padding: 2px 0 3px;
            border: 1px solid #cacaca;
            border-top: 0;
            cursor: auto;
            background: #fcfcfc;
            background: -moz-linear-gradient(top, #fcfcfc 61%, #f7f7f7 100%);
            background: -webkit-linear-gradient(top, #fcfcfc 61%, #f7f7f7 100%);
            background: linear-gradient(to bottom, #fcfcfc 61%, #f7f7f7 100%);
        }

        .mResizer.theme3 button {
            position: relative;
            overflow: hidden;
            width: 26px;
            height: 23px;
            border-radius: 3px;
            white-space: nowrap;
            text-indent: 150%;
            vertical-align: middle;
            background: transparent;
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .mResizer.theme3 button:hover {
            background: #e7e7e7;
        }

        .mResizer.theme3 button:active {
            box-shadow: inset 0 -1px 2px rgba(0, 0, 0, .05);
        }

        .mResizer.theme3 button:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            top: 50%;
            left: 50%;
            margin: -3px 0 0 -5px;
            border-style: solid;
        }

        .mResizer.theme3 .btnExpand:after {
            border-width: 6px 5px 0 5px;
            border-color: #5a5a5a transparent transparent transparent;
        }

        .mResizer.theme3 .btnReduce:after {
            border-width: 0 5px 6px 5px;
            border-color: transparent transparent #5a5a5a transparent;
        }

        /* 품목 필터링 */
        .mFilter {
            position: relative;
            display: inline-block;
        }

        .mFilter .btnFilter {
            overflow: hidden;
            display: inline-block;
            width: 21px;
            height: 21px;
            vertical-align: middle;
            text-indent: 120%;
            font-size: 0;
            line-height: 0;
            white-space: nowrap;
            background: url("//img.echosting.cafe24.com/ec/product/btn_filter.png") no-repeat 0 0;
        }

        .mFilter .btnFilter:hover,
        .mFilter .btnFilter.selected {
            background-position: -30px 0;
        }

        .mFilter .list {
            display: none;
            position: absolute;
            right: 0;
            top: 22px;
            z-index: 9;
            max-height: 320px;
            overflow-y: auto;
            overflow-x: hidden;
            min-width: 137px;
            width: 156px;
            border: 1px solid #6e92be;
            border-radius: 2px;
            text-align: left;
            background: #fff;
        }

        .mFilter .list > li {
            padding: 0 10px;
        }

        .mFilter .list > li > a {
            position: relative;
            display: block;
            padding: 6px 0 6px 10px;
            font-weight: bold;
            border-top: 1px solid #dbdbdb;
            text-decoration: none;
        }

        .mFilter .list > li.all > a {
            padding: 8px 10px 7px;
            border-top: 0;
        }

        .mFilter .list > li > a:after {
            content: "";
            position: absolute;
            right: 5px;
            top: 12px;
            display: inline-block;
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-top: 5px solid #4f4f4f;
            border-right: 4px solid transparent;
        }

        .mFilter .list > li.all > a:after {
            content: none;
            display: none;
        }

        .mFilter .list > li .subList {
            display: none;
            padding-bottom: 1px;
        }

        .mFilter .list > li .subList li a {
            display: block;
            padding: 0 0 4px 20px;
        }

        .mFilter .list > li .subList li a:hover, .mFilter .list > li .subList li.selected a {
            color: #479aed;
            text-decoration: underline;
        }

        .mFilter .list > li .subList li.disabled a:hover {
            color: #bababa;
            text-decoration: none;
        }

        .mFilter .list > li.selected,
        .mFilter .list > li .subList li.selected {
            background: none;
        }

        .mFilter .list > li.selected .subList {
            display: block;
            background: none;
        }

        .mFilter .list > li.selected > a:after {
            border-top: 0;
            border-bottom: 5px solid #4f4f4f;
        }

        /* typeSelect */
        .mFilter.typeSelect .list > li {
            margin: 0 10px;
            padding: 6px 0;
        }

        .mFilter.typeSelect .list > li + li {
            border-top: 1px solid #dbdbdb;
        }

        .mFilter.typeSelect .list > li label {
            position: relative;
            color: #1c1c1c;
            letter-spacing: -1px;
        }

        .mFilter.typeSelect .list > li label .fChk {
            float: none;
            margin: 0;
        }

        .mFilter.typeSelect .list > li .subList {
            margin: 6px 0 0 20px;
        }

        .mFilter.typeSelect .list > li .subList li + li {
            padding: 6px 0 0;
        }

        .mFilter.typeSelect .list > li .subItem {
            display: block;
            position: relative;
        }

        .mFilter.typeSelect .list > li .subList .selected > label {
            color: #479aed;
        }

        .mFilter.typeSelect .list > li .subList .disabled > label {
            color: #bababa;
        }

        .mFilter.typeSelect .list > li .toggle {
            position: absolute;
            right: 0;
            top: -1px;
            width: 20px;
            height: 20px;
        }

        .mFilter.typeSelect .list > li .toggle:after {
            content: '';
            position: absolute;
            top: 8px;
            left: 6px;
            border-left: 4px solid transparent;
            border-top: 5px solid #4f4f4f;
            border-right: 4px solid transparent;
        }

        .mFilter.typeSelect .list > li.selected .toggle:after {
            border-top: 0;
            border-bottom: 5px solid #4f4f4f;
        }

        /* popup reset */
        #popup .mFilter .list {
            margin-bottom: 60px;
        }

        /* mController (pickerArea, multipleArea) */
        .mController {
            z-index: 1;
            position: absolute;
            left: 50%;
            top: 0;
            overflow: hidden;
            height: 100%;
        }

        .mController .button {
            overflow: hidden;
            display: table;
            width: 100%;
            height: 100%;
            background-color: #fff;
        }

        .mController p {
            display: table-cell;
            vertical-align: middle;
        }

        /* multipleArea */
        .multipleArea {
            position: relative;
            width: 659px;
            max-width: 100%;
        }

        .multipleArea:after {
            content: "";
            display: block;
            clear: both;
        }

        .multipleArea.gCenter {
            margin: 0 auto;
        }

        .multipleArea > .gCtrl {
            position: relative;
            margin: 0 0 5px;
            padding: 0 30px 0 0;
            width: 50%;
            box-sizing: border-box;
        }

        .multipleArea > .gCtrl > select {
            min-width: 100%;
        }

        .multipleArea .gFlow,
        .multipleArea .gReverse {
            float: left;
            width: 50%;
        }

        .multipleArea .gFlow {
            margin: 0 -1px 0 0;
        }

        /* multipleArea Reset */
        #popup .multipleArea {
            width: 450px;
        }

        .multipleArea .mController {
            width: 32px;
            margin: 0 0 0 -16px;
        }

        .multipleArea .mController .button button {
            display: block;
            margin: 3px auto;
        }

        /* lang reset */
        html:lang(en) .multipleArea .mController {
            width: 35px;
            margin-left: -19px;
        }

        /* mMultiple */
        .mMultiple.gSmall {
            width: 300px;
        }

        .mMultiple.gMedium {
            width: 450px;
        }

        .mMultiple.gLarge {
            width: 600px;
        }

        .mMultiple .fMultiple {
            width: 100%;
            height: 100px;
        }

        .mMultiple.clearBorder .fMultiple {
            border: 0;
        }

        /* mMultiple Reset */
        .multipleArea .gFlow .mMultiple {
            margin: 0 30px 0 0;
        }

        .multipleArea .gReverse .mMultiple {
            margin: 0 0 0 29px;
        }

        .mMultiple .ctrlHeight {
            margin-top: -1px;
            height: 15px;
            border: 1px solid #cacaca;
            background: #f8f8f8;
        }

        .mMultiple .ctrlHeight span {
            width: 10px;
            height: 6px;
            background: url("//img.echosting.cafe24.com/suio/sfix_resizer.png") no-repeat 0 0;
        }

        .mMultiple .mResizer.theme2 {
            height: 17px;
            border-color: #cacaca;
        }

        .mMultiple .mResizer.theme2 span {
            width: 15px;
            height: 7px;
            background-position: -3px -28px;
        }

        /* mSelect */
        .mSelect.gSmall {
            width: 300px;
        }

        .mSelect.gMedium {
            width: 450px;
        }

        .mSelect.gLarge {
            width: 600px;
        }

        .mSelect > ul {
            overflow: auto;
            position: relative;
            width: 100%;
            height: 100px;
            border: 1px solid #cacaca;
            box-sizing: border-box;
        }

        .mSelect > ul > li.selected {
            background: #e3e7f0;
        }

        .mSelect li {
            position: relative;
            margin: 0;
            padding: 5px;
            line-height: 140%;
        }

        .mSelect li strong {
            display: block;
            font-weight: normal;
            cursor: pointer;
        }

        .mSelect.gFunction li strong {
            padding: 0 30px 0 0;
        }

        .mSelect.gCheck li strong {
            padding: 0 78px 0 0;
        }

        .mSelect.gCheck li label {
            position: absolute;
            right: 30px;
            top: 4px;
        }

        .mSelect li .btnIcon {
            display: none;
            position: absolute;
            right: 5px;
            top: 3px;
        }

        .mSelect li.selected .btnIcon {
            display: block;
        }

        .mSelect .ctrlHeight {
            margin-top: -1px;
            height: 15px;
            border: 1px solid #cacaca;
            background: #f8f8f8;
        }

        .mSelect .ctrlHeight span {
            width: 10px;
            height: 6px;
            background: url("//img.echosting.cafe24.com/suio/sfix_resizer.png") no-repeat 0 0;
        }

        .mSelect .mResizer.theme2 {
            height: 17px;
            border-color: #cacaca;
        }

        .mSelect .mResizer.theme2 span {
            width: 15px;
            height: 7px;
            background-position: -3px -28px;
        }

        /* mSelect Reset */
        .multipleArea .gFlow .mSelect {
            margin: 0 30px 0 0;
        }

        .multipleArea .gReverse .mSelect {
            margin: 0 0 0 29px;
        }

        .multipleArea .gReverse .mSelect > ul {
            width: 99%;
        }

        .mMultiple .gCtrl, .mSelect .gCtrl {
            position: relative;
            line-height: 22px;
            min-height: 22px;
            padding: 0 50px 5px 0;
        }

        .mMultiple .gCtrl p.edit, .mSelect .gCtrl p.edit {
            position: absolute;
            right: 0;
            bottom: 6px;
        }

        .multipleArea > .gCtrl p.edit {
            position: absolute;
            right: 30px;
            bottom: 1px;
        }

        .mMultiple .gCtrl.full, .mSelect .gCtrl.full {
            padding-right: 0;
        }

        /* pickerArea */
        .pickerArea {
            position: relative;
            margin: 0 0 30px;
            border: 1px solid #bbc0c4;
        }

        .pickerArea:after {
            content: "";
            display: block;
            clear: both;
        }

        /* grid */
        .pickerArea.grid1 .mCondition {
            height: 90px;
        }

        .pickerArea.grid2 .mCondition {
            height: 120px;
        }

        html:lang(vi) .pickerArea.grid2 .mCondition {
            height: 145px;
        }

        .pickerArea.grid3 .mCondition {
            height: 160px;
        }

        /* tbody height */
        .pickerArea .mBoard.typeBody {
            height: 344px;
            max-height: none;
        }

        .pickerArea .gReverse .mBoard.typeBody {
            height: 264px;
        }

        .pickerArea.gInsert .gReverse .mBoard.typeBody {
            height: 315px;
        }

        .pickerArea.gPage .gReverse .mBoard.typeBody {
            height: 307px;
        }

        .pickerArea.gEmpty .gReverse .mBoard.typeBody {
            height: 358px;
        }

        .pickerArea.grid1.gFull .gReverse .mBoard.typeBody {
            height: 478px;
        }

        .pickerArea.grid2.gFull .gReverse .mBoard.typeBody {
            height: 508px;
        }

        .pickerArea.grid3.gFull .gReverse .mBoard.typeBody {
            height: 548px;
        }

        /* popup, layer popup */
        #popup .pickerArea .mBoard.typeBody,
        .mLayer .pickerArea .mBoard.typeBody {
            height: 206px;
        }

        #popup .pickerArea .gReverse .mBoard.typeBody,
        .mLayer .pickerArea .gReverse .mBoard.typeBody {
            height: 126px;
        }

        #popup .pickerArea.gInsert .gReverse .mBoard.typeBody,
        .mLayer .pickerArea.gInsert .gReverse .mBoard.typeBody {
            height: 177px;
        }

        #popup .pickerArea.gPage .gReverse .mBoard.typeBody,
        .mLayer .pickerArea.gPage .gReverse .mBoard.typeBody {
            height: 169px;
        }

        #popup .pickerArea.gEmpty .gReverse .mBoard.typeBody,
        .mLayer .pickerArea.gEmpty .gReverse .mBoard.typeBody {
            height: 220px;
        }

        #popup .pickerArea.grid1.gFull .gReverse .mBoard.typeBody,
        .mLayer .pickerArea.grid1.gFull .gReverse .mBoard.typeBody {
            height: 340px;
        }

        #popup .pickerArea.grid2.gFull .gReverse .mBoard.typeBody,
        .mLayer .pickerArea.grid2.gFull .gReverse .mBoard.typeBody {
            height: 380px;
        }

        #popup .pickerArea.grid3.gFull .gReverse .mBoard.typeBody,
        .mLayer .pickerArea.grid3.gFull .gReverse .mBoard.typeBody {
            height: 410px;
        }

        /* common, reset */
        .pickerArea h2 {
            position: relative;
            height: 26px;
            padding: 9px 0 0 14px;
            margin-bottom: -1px;
            border-bottom: 1px solid #bbc0c4;
            font-size: 13px;
            font-family: gulim, sans-serif;
        }

        html:lang(ja) .pickerArea h2 {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .pickerArea h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .pickerArea h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .pickerArea .mPaginate {
            margin-top: 0;
            min-height: 20px;
            padding: 15px 0;
            border-top: 1px solid #d9dadc;
        }

        .pickerArea .mState {
            min-height: 23px;
            margin: 0;
            padding: 0 10px 7px 14px;
        }

        .pickerArea .mState .total {
            padding: 3px 0 0;
        }

        .pickerArea .mBoardArea .mBoard {
            border-bottom: 0;
        }

        .pickerArea .mInsert {
            border: 0;
            border-top: 1px solid #bcbfc4;
            margin: 0;
        }

        .pickerArea .mCtrl.typeFooter {
            margin: 0;
        }

        /* gFlow */
        .pickerArea .gFlow {
            float: left;
            width: 50%;
            margin-right: -1px;
        }

        .pickerArea .gFlow h2 {
            background: #dde1e5;
        }

        .pickerArea .gFlow .mPicker {
            margin: 0 32px 0 0;
        }

        .pickerArea .gFlow .mBoard th:first-child,
        .pickerArea .gFlow .mBoard td:first-child,
        .pickerArea .gFlow .mCtrl {
            border-left: 0;
        }

        .pickerArea .gFlow .mCtrl {
            border-bottom: 0;
        }

        .pickerArea .gFlow .mCondition .mBoard td {
            border-right: 0;
        }

        /* mController */
        .pickerArea .mController {
            top: -1px;
            bottom: -1px;
            height: 100%;
            width: 64px;
            margin: 0 0 0 -33px;
            border: 1px solid #bbc0c4;
        }

        .pickerArea .mController .btnAdd {
            display: block;
            overflow: hidden;
            width: 32px;
            height: 80px;
            margin: 10px auto 0;
            text-decoration: none;
            white-space: nowrap;
            text-indent: 150%;
            background: url("//img.echosting.cafe24.com/suio/ko_KR/sfix_picker2.png") no-repeat 0 0;
        }

        html:lang(ja) .pickerArea .mController .btnAdd {
            background-image: url("//img.echosting.cafe24.com/suio/ja_JP/sfix_picker2.png");
        }

        html:lang(vi) .pickerArea .mController .btnAdd {
            background-image: url("//img.echosting.cafe24.com/suio/vi_VN/sfix_picker2.png");
        }

        html:lang(en) .pickerArea .mController .btnAdd {
            background-image: url("//img.echosting.cafe24.com/suio/en_US/sfix_picker2.png");
        }

        .pickerArea .mController .btnAdd:first-child {
            margin-top: 0;
        }

        .pickerArea .mController .btnAdd.typeAll {
            background-position: -84px 0;
        }

        /* gReverse */
        .pickerArea .gReverse {
            position: relative;
            left: 1px;
            *left: 0;
            float: left;
            width: 50%;
        }

        .pickerArea .gReverse h2 {
            background: #c1c1c6;
        }

        .pickerArea .gReverse .mPicker {
            margin: 0 0 0 32px;
        }

        .pickerArea .gReverse .mBoardArea .mBoard,
        .pickerArea .gReverse .mBoard td {
            border-right: 0;
        }

        .pickerArea .gReverse .mCtrl {
            border-right: 0;
            border-bottom: 0;
        }

        /* mSms */
        .mSms {
            width: 198px;
        }

        .mSms .preview {
            height: 188px;
            background: url("//img.echosting.cafe24.com/suio/sfix_sms.png") no-repeat 0 0;
        }

        .mSms .preview .sms {
            height: 30px;
            padding: 12px 0 0 0;
            color: #2a2a2a;
            font-weight: bold;
            text-align: center;
        }

        .mSms .preview .sms span {
            margin: 0 0 0 6px;
            padding: 0 0 0 7px;
            background: url("//img.echosting.cafe24.com/suio/sfix_sms.png") no-repeat -355px 1px;
        }

        .mSms .preview .sms em {
            margin: 0 2px 0 0;
            color: #2a74b7;
            font-style: normal;
            font-family: verdana, sans-serif;
            font-size: 14px;
            letter-spacing: -1px;
        }

        .mSms .preview textarea {
            overflow: hidden;
            width: 166px;
            height: 96px;
            padding: 20px 16px 0;
            border: 0;
            color: #333;
            line-height: 160%;
            resize: none;
            background: transparent;
            outline: 0;
        }

        .mSms .preview .byte {
            height: 30px;
            padding: 0 16px 0 0;
            color: #000;
            font-size: 11px;
            letter-spacing: 0;
            text-align: right;
            line-height: 30px;
        }

        .mSms .info {
            margin: 10px 0 0;
            border: 1px solid #b6b9bd;
            border-radius: 5px;
            background-color: #fafbfb;
        }

        .mSms .info li {
            padding: 6px 0;
            border-top: 1px solid #dfdfdf;
        }

        .mSms .info li:first-child {
            border: 0;
        }

        .mSms .info li label {
            display: inline-block;
            width: 65px;
            padding: 0 0 0 10px;
            color: #555;
            font-size: 11px;
            letter-spacing: 0;
            font-weight: bold;
            letter-spacing: -1px;
        }

        .mSms .info li input {
            width: 97px;
        }

        .mSms .button {
            margin: 10px 0 0;
        }

        .mSms .button a {
            overflow: hidden;
            display: inline-block;
            width: 97px;
            height: 32px;
            font-size: 0;
            line-height: 100px;
            white-space: nowrap;
            background-image: url("//img.echosting.cafe24.com/suio/sfix_sms.png");
            background-repeat: no-repeat;
        }

        .mSms .button .btnSend {
            background-position: -208px 0;
        }

        .mSms .button .btnSendCancel {
            background-position: -208px -42px;
        }

        /* mImgSelect */
        .mImgSelect li {
            display: inline-block;
            margin: 12px 24px 12px 0;
            text-align: center;
            vertical-align: top;
        }

        .mImgSelect li label {
            display: inline-block;
        }

        .mImgSelect li label img {
            vertical-align: middle;
        }

        .mImgSelect .border {
            display: inline-block;
            position: relative;
            margin: 3px 0 0;
            padding: 1px;
            border: 1px solid #d6dae1;
            box-sizing: border-box;
            text-align: center;
        }

        .mImgSelect .border .icoDelete {
            display: none;
            position: absolute;
            top: -1px;
            right: -1px;
        }

        .mImgSelect .border:hover .icoDelete {
            display: block;
        }

        .mImgSelect .eSelected .border {
            padding: 0;
            border: 2px solid #3971ff;
        }

        .mImgSelect .eSelected .border .icoDelete {
            top: -3px;
            right: -3px;
        }

        .mImgSelect .fChk {
            margin: 0 5px 5px;
            vertical-align: top;
        }

        .mImgSelect li > a, .mImgSelect .button > a, .mImgSelect li > button, .mImgSelect .button > button {
            margin: 8px 1px 3px;
        }

        .mImgSelect .button {
            text-align: center;
        }

        .mImgSelect .border > img {
            max-width: 90%;
            max-height: 90%;
        }

        .mImgSelect .text {
            display: inline-block;
            position: relative;
            overflow: hidden;
            padding: 0 0 0 18px;
            vertical-align: top;
            font-weight: normal;
            line-height: 1.5;
            letter-spacing: 0;
            word-break: break-all;
        }

        .mImgSelect .text .fChk {
            position: absolute;
            top: 0;
            left: 0;
            margin: 2px 0 0;
        }

        .mImgSelect .text.left {
            float: left;
        }

        .mImgSelect .text.right {
            float: right;
        }

        .mImgSelect .text.center {
            padding-right: 7px;
        }

        .mImgSelect .text:after {
            content: '';
            display: block;
            clear: both;
        }

        .mImgSelect.gHor li, .mImgSelect.gVer li {
            vertical-align: top;
        }

        .mImgSelect.gHor .border, .mImgSelect.gVer .border {
            margin-right: 5px;
        }

        .mImgSelect.gHor .button {
            display: inline-block;
            padding: 0;
            vertical-align: top;
            text-align: left;
        }

        .mImgSelect.gHor .button > a, .mImgSelect.gHor .button > button {
            margin: 5px 4px 0 0;
        }

        .mImgSelect.gVer .button {
            padding: 0 0 0 29px;
        }

        .mImgSelect.gFull li {
            display: block;
            text-align: left;
        }

        .mImgSelect.gFull.gDefault li {
            text-align: center;
        }

        .mImgSelect.gFull.gFlex {
            display: flex;
        }

        .mImgSelect.gFull.gFlex li {
            margin: 12px 10px 12px 0;
        }

        .mImgSelect.gFull.gFlex li img {
            width: 100%;
        }

        /* mThumbList */
        .mThumbList {
            width: auto;
        }

        .mThumbList li {
            margin: 8px 0 0 0;
        }

        .mThumbList:after {
            content: "";
            display: block;
            clear: both;
        }

        /* typeHor */
        .mThumbList.typeHor li {
            display: inline-block;
            margin: 8px 6px 0 0;
            vertical-align: top;
        }

        .mThumbList.typeHor li .frame,
        .mThumbList.typeHor li .figure {
            display: block;
            margin: 0 0 10px 0;
        }

        .mThumbList.typeHor li .title {
            display: block;
            margin: 0 0 5px;
            text-align: left;
        }

        .mThumbList.typeHor li .button {
            display: block;
            text-align: center;
        }

        .mThumbList.typeHor li span.zoom + .button {
            display: block;
            margin: 8px 0 0;
        }

        .mThumbList.typeHor li > .mList li {
            display: block;
            margin: 0;
        }

        /* typeVer */
        .mThumbList.typeVer li {
            margin: 10px 5px 8px 0;
        }

        .mThumbList.typeVer li:first-child {
            margin-top: 0;
        }

        .mThumbList.typeVer .frame,
        .mThumbList.typeVer .figure {
            display: inline-block;
            margin: 0 6px 0 0;
            vertical-align: top;
        }

        /* typeBoard */
        .mThumbList.typeBoard {
            margin: 0;
            overflow: hidden;
        }

        .mThumbList.typeBoard ul {
            font-size: 0;
            line-height: 0;
        }

        .mThumbList.typeBoard li {
            display: inline-block;
            vertical-align: top;
            color: #898989;
            font-size: 12px;
            line-height: 1.4em;
        }

        html:lang(ko) .mThumbList.typeBoard li {
            font-size: 13px;
        }

        .mThumbList.typeBoard .check {
            display: block;
            padding: 0 0 5px;
        }

        .mThumbList.typeBoard .thumb {
            display: table-cell;
            padding: 2px;
            border: 1px solid #ccc;
            text-align: center;
            vertical-align: middle;
        }

        .mThumbList.typeBoard .thumb img {
            padding: 0;
            border: 0;
        }

        .mThumbList.typeBoard .name {
            display: block;
            margin: 9px 0 5px 5px;
            color: #898989;
            font-size: 11px;
            letter-spacing: 0;
        }

        .mThumbList.typeBoard .price {
            display: block;
            margin: 5px 0 0 5px;
            color: #5aa2e3;
        }

        /* grid */
        .mThumbList.typeBoard.grid5 ul {
            margin: -10px 0 0 -23px;
        }

        .mThumbList.typeBoard.grid5 li {
            width: 180px;
            margin: 20px 0 20px 29px;
        }

        .mThumbList.typeBoard.grid5 .thumb {
            width: 174px;
            height: 174px;
        }

        .mThumbList.typeBoard.grid5 .thumb img {
            max-width: 174px;
            max-height: 174px;
        }

        /* mThumbList Reset */
        .mBoard td .mThumbList:first-child, .mBox .mThumbList:first-child {
            margin-top: 0;
        }

        /* mAttach */
        /* typeFile */
        .mAttach.typeFile:after {
            content: '';
            display: block;
            clear: both;
        }

        .mAttach.typeFile li {
            margin: 10px 0 0;
            line-height: 18px;
        }

        .mAttach.typeFile li:first-child {
            margin-top: 0;
        }

        .mAttach.typeFile .attached {
            display: inline-block;
            height: 18px;
            padding: 0 0 0 23px;
            line-height: 18px;
            word-break: break-all;
            background: url("//img.echosting.cafe24.com/suio/sflex_attachment.png") no-repeat -134px -600px;
        }

        .mAttach.typeFile a[href$=".xls"],
        .mAttach.typeFile a[href$=".xlsx"] {
            background-position: -434px 0;
        }

        .mAttach.typeFile a[href$=".doc"],
        .mAttach.typeFile a[href$=".docx"] {
            background-position: -384px -100px;
        }

        .mAttach.typeFile a[href$=".ppt"],
        .mAttach.typeFile a[href$=".pptx"] {
            background-position: -334px -200px;
        }

        .mAttach.typeFile a[href$=".pdf"] {
            background-position: -284px -300px;
        }

        .mAttach.typeFile a[href$=".hwp"] {
            background-position: -234px -400px;
        }

        .mAttach.typeFile a[href$=".txt"] {
            background-position: -184px -500px;
        }

        .mAttach.typeFile a[href$=".psd"] {
            background-position: -84px -700px;
        }

        .mAttach.typeFile a[href$=".zip"] {
            background-position: -34px -800px;
        }

        .mAttach.typeFile a[href$=".jpg"] {
            background-position: -434px -900px;
        }

        .mAttach.typeFile a[href$=".png"] {
            background-position: -384px -1000px;
        }

        .mAttach.typeFile a[href$=".gif"] {
            background-position: -334px -1100px;
        }

        .mAttach.typeFile a[href$=".html"] {
            background-position: -284px -1200px;
        }

        .mAttach .icoDel {
            vertical-align: top;
        }

        .mAttach.typeFile li .unit {
            float: right;
            margin: 2px 0 0;
            font-size: 11px;
            letter-spacing: 0;
            color: #898989;
        }

        /* typeEmpty */
        .mAttach.typeEmpty .text {
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            padding: 0;
            border: 0;
            font-size: 12px;
            color: #898989;
            text-align: center;
            -webkit-transform: translate(0, -50%);
            -moz-transform: translate(0, -50%);
            -ms-transform: translate(0, -50%);
            transform: translate(0, -50%);
        }

        html:lang(ko) .mAttach.typeEmpty .text {
            font-size: 13px;
        }

        div.mAttach.typeFile.gScroll {
            overflow-x: hidden;
            overflow-y: auto;
            height: 68px;
        }

        div.mAttach.typeFile,
        div.mAttach.typeEmpty {
            position: relative;
            min-height: 68px;
            margin: 8px 0 0;
            padding: 5px 10px;
            border: 1px solid #f1f1f1;
        }

        div.mAttach.typeFile li {
            margin: 0;
            padding: 5px 0;
        }

        /* typeImage */
        .mAttach.typeImage li {
            margin: 10px 0 0;
        }

        .mAttach.typeImage li .frame,
        .mAttach.typeImage li .figure {
            margin: 0 2px 0 0;
        }

        .mAttach.typeImage li .icoDel {
            vertical-align: top;
        }

        .mAttach.typeImage.gHor li {
            display: inline-block;
            margin-right: 16px;
            vertical-align: top;
        }

        /* typeView */
        .mAttach.typeView .thumb {
            position: relative;
            display: inline-block;
            margin: 0 15px 0 0;
            vertical-align: top;
            text-align: center;
        }

        .mAttach.typeView .info {
            margin: 5px 0 0;
        }

        .mAttach.typeView .thumb .zoom {
            overflow: hidden;
        }

        .mAttach.typeView .thumb .button {
            margin: 5px 0 0;
        }

        .mAttach.typeView.gHor > .thumb {
            position: relative;
            display: inline-block;
            margin: 0 15px 0 0;
        }

        .mAttach.typeView.gHor > .info {
            display: inline-block;
            margin: 0;
            vertical-align: top;
        }

        /* mAttach Reset */
        .txtInfo + .mAttach.typeFile li:first-child {
            margin-top: 10px;
        }


        /* mBox */
        .mBox {
            margin: 8px 0 0;
            padding: 17px 24px;
        }

        td .mBox:first-child {
            margin-top: 0;
        }

        .mBox:after {
            content: "";
            display: block;
            clear: both;
        }

        .mBox .gLeft {
            float: left;
        }

        .mBox .gRight {
            float: right;
        }

        .mBox .gLeft.gMiddle {
            padding: 7px 0 0;
        }

        .mBox.typeEmpty {
            padding: 0;
            border: 0;
        }

        .mBox.typeBorder {
            border: 1px solid #d6dae1;
        }

        .mBox.typeBorder p.empty {
            border: 0;
        }

        .mBox.typeAll {
            border: 1px solid #d6dae1;
            background-color: #fafafd;
        }

        .mBox.typeBg {
            border: 1px solid #d6dae1;
            background-color: #fafafd;
        }

        .mBox.typeInfo {
            margin: 10px 0;
            padding: 10px 30px 9px;
            color: #1c1c1c;
            border: 1px solid #94c3ef;
            background: #e1f0fe url("//img.echosting.cafe24.com/suio/sflex_box.png") no-repeat -477px 13px;
        }

        .mBox.typeInfo.gCenter {
            background-image: none;
        }

        .mBox.typeFrame {
            padding: 0;
            border: 1px solid #e2e5ea;
        }

        .mBox.typeFrame .fTextarea {
            width: 100%;
            max-height: 223px;
            border: 0;
        }

        .mBox.typeFrame .term {
            overflow-y: auto;
            height: 130px;
            padding: 10px;
        }

        .mBox.gCenter {
            text-align: center;
        }

        .mBox.gCenter .icoPoint {
            display: inline-block;
            width: 10px;
            height: 10px;
            margin: 0 8px 0 0;
            background: url("//img.echosting.cafe24.com/suio/sflex_box.png") no-repeat -490px 0;
        }

        .mBox.gNoMargin {
            margin-top: 0;
        }

        .mBox.gScroll {
            overflow-y: auto;
            height: 100px;
            padding: 0 5px;
        }

        .mBox.gStrong {
            background-color: #f4f9ff;
        }

        /* mBox gClear */
        .mBox .gClear {
            overflow: hidden;
            clear: both;
        }

        /* mBox gBox */
        .mBox .gBox {
            padding: 7px 15px 6px;
            border: 1px solid #e8e8e8;
            line-height: 1.7;
            color: #555;
            background: #fff;
        }

        .mBox .gBox .title {
            display: block;
            margin: 0 0 3px;
            color: #fd5426;
        }

        /* mBox Reset */
        .mLayer .mBox {
            margin: 5px 0 0;
            padding: 7px;
        }

        .mLayer .mBox.typeEmpty,
        .mLayer .mBox.typeFrame {
            padding: 0;
        }

        .mLayer .mBox.typeInfo {
            padding: 10px 30px 9px;
        }

        .mTooltip .mBox {
            padding: 7px 10px;
        }

        /* mBox + mTab */
        .mBox + .mTab {
            margin-top: 20px;
        }

        /* mCtrl typeHeader + mBox typeBorder */
        .mCtrl.typeHeader + .mBox.typeBorder,
        .mCtrl.typeSetting + .mBox.typeBorder {
            margin-top: 0;
            padding: 4px 16px;
        }

        /* mInfo + typePage */
        .mInfo.typePage {
            position: relative;
            padding: 80px 20px 80px 345px;
            color: #555;
        }

        .mInfo.typePage .visual {
            position: absolute;
            left: 20px;
            top: 80px;
            width: 286px;
            height: 170px;
        }

        .mInfo.typePage .visual img {
            max-width: 100%;
            max-height: 100%;
        }

        .mInfo.typePage h2 {
            margin-left: -3px;
            font-size: 30px;
            line-height: 34px;
            color: #000;
            letter-spacing: -1px;
            word-spacing: -1px;
        }

        html:lang(ja) .mInfo.typePage h2 {
            font-family: Helvetica, Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
        }

        html:lang(vi) .mInfo.typePage h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mInfo.typePage h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mInfo.typePage .detail {
            margin: 30px 0 0;
            line-height: 1.5;
        }

        .mInfo.typePage .detail p {
            margin: 8px 0;
        }

        .mInfo.typePage .content {
            padding: 10px 0 9px;
        }

        .mInfo.typePage .content.typeBorder {
            border-top: 1px dashed #c8c9cb;
        }

        .mInfo.typePage .content h3 {
            padding: 10px 0 0 22px;
            font-size: 12px;
            color: #555;
            background: url("//img.echosting.cafe24.com/suio/sflex_info.png") no-repeat -85px -190px;
        }

        html:lang(ko) .mInfo.typePage .content h3 {
            font-size: 13px;
        }

        .mInfo.typePage .content .step li {
            position: relative;
            padding: 3px 0 4px 25px;
            min-height: 12px;
            font-size: 11px;
            letter-spacing: 0;
            word-spacing: -1px;
        }

        .mInfo.typePage .content .step li .number {
            position: absolute;
            left: 0;
            top: 3px;
            width: 14px;
            height: 14px;
            line-height: 12px;
            font-size: 10px;
            line-height: 14px;
            color: #444;
            text-align: center;
            font-family: Tahoma;
            background: url("//img.echosting.cafe24.com/suio/sflex_info.png") no-repeat -186px 0;
        }

        .mInfo.typePage .customer {
            margin: 10px 0 30px;
            padding: 10px 0 0 18px;
            font-size: 11px;
            letter-spacing: 0;
            border-top: 1px dashed #c8c9cb;
            background: url("//img.echosting.cafe24.com/suio/sflex_info.png") no-repeat -138px -90px;
        }

        .mInfo.typePage .button {
            margin: 20px 0 0;
        }

        /* mInfo + typeCont */
        .mInfo.typeCont {
            position: relative;
            padding: 75px 20px 40px 345px;
            color: #555;
        }

        .mInfo.typeCont .visual {
            position: absolute;
            left: 20px;
            top: 25px;
            width: 286px;
            height: 170px;
        }

        .mInfo.typeCont .visual img {
            max-width: 100%;
            max-height: 100%;
        }

        .mInfo.typeCont h2 {
            margin-left: -3px;
            font-size: 30px;
            line-height: 34px;
            color: #000;
            letter-spacing: -1px;
            word-spacing: -1px;
        }

        html:lang(ja) .mInfo.typeCont h2 {
            font-family: Helvetica, Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
        }

        html:lang(vi) .mInfo.typeCont h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mInfo.typeCont h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mInfo.typeCont .detail {
            margin: 20px 0 0;
        }

        .mInfo.typeCont .detail p {
            margin: 8px 0;
        }

        .mInfo.typeCont .detail > ul.normal li {
            padding: 0 0 0 10px;
            line-height: 1.4;
            background: url("//img.echosting.cafe24.com/suio/sflex_heading.png") -295px -393px no-repeat;
        }

        .mInfo.typeCont.noAccess {
            margin: 180px 0 0 119px;
            padding: 60px 20px 40px 345px;
        }

        /* mInfo + typeState */
        .mInfo.typeState {
            max-width: 1000px;
            margin: 0 0 100px;
            padding: 95px 0 0;
        }

        .mInfo.typeState .visual {
            text-align: center;
        }

        .mInfo.typeState h2 {
            margin: 19px 0 24px;
            font-size: 37px;
            font-weight: normal;
            letter-spacing: -1px;
            word-spacing: -4px;
            text-align: center;
        }

        html:lang(ja) .mInfo.typeState h2 {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mInfo.typeState h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mInfo.typeState h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mInfo.typeState .detail {
            position: relative;
            width: 660px;
            margin: 50px auto 0;
            padding: 33px 70px 27px 109px;
            box-sizing: border-box;
            border: 1px solid #eaeaea;
        }

        .mInfo.typeState .detail:before {
            content: "";
            position: absolute;
            top: 33px;
            left: 69px;
            display: inline-block;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #9da6b4 url("//img.echosting.cafe24.com/suio/ico_info_state.png") no-repeat center;
        }

        .mInfo.typeState .detail p,
        .mInfo.typeState .detail ul li,
        .mInfo.typeState .detail ol li {
            margin: 0 0 4px;
            line-height: 18px;
        }

        .mInfo.typeState .detail .content {
            margin: 20px 0 0;
        }

        .mInfo.typeState .detail .content:first-child {
            margin-top: 0;
        }

        .mInfo.typeState .mButton .btnInfo {
            display: inline-block;
            height: 44px;
            padding: 0 40px;
            border-radius: 4px;
            font-weight: normal;
            font-size: 20px;
            line-height: 44px;
            color: #fff;
            background: #2a3a54;
        }

        html:lang(ja) .mInfo.typeState .mButton .btnInfo {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mInfo.typeState .mButton .btnInfo {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mInfo.typeState .mButton .btnInfo {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mInfo.typeState .mButton a:hover {
            text-decoration: none;
        }

        /* mInfo + typeMobile */
        .mInfo.typeMobile {
            padding: 40px 0;
            text-align: center;
            color: #555;
        }

        .mInfo.typeMobile .visual {
            margin: 0 auto;
            width: 137px;
            height: 80px;
        }

        .mInfo.typeMobile .visual img {
            max-width: 100%;
            max-height: 100%;
        }

        .mInfo.typeMobile h2 {
            padding: 30px 20px 0;
            font-size: 23px;
            line-height: 24px;
            letter-spacing: -1px;
        }

        html:lang(ja) .mInfo.typeMobile h2 {
            font-family: Helvetica, Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
        }

        html:lang(vi) .mInfo.typeMobile h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mInfo.typeMobile h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mInfo.typeMobile .detail {
            margin: 15px 0 0;
        }

        .mInfo.typeMobile .detail p {
            font-size: 13px;
            color: #434343;
        }

        /* mZipcode */
        .zipCodeArea .txtZip {
            margin: 10px 0;
            color: #1b87d4;
        }

        .zipCodeArea .areaList {
            margin: 0 0 15px;
        }

        .zipCodeArea .areaList label {
            margin-bottom: 5px;
        }

        .mZipcode fieldset {
            margin: 0 0 10px;
            padding: 5px 0;
            border: 1px solid #ebebeb;
            text-align: center;
            background: #f5f4f4;
        }

        .mZipcode .fSelect {
            display: inline-block;
        }

        .mZipcode .txtZip {
            margin: 20px 0 5px;
            color: #1b87d4;
        }

        .mZipcode .zipList {
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
            height: 340px;
            border: 1px solid #a7a7a7;
        }

        .mZipcode .zipList thead {
            display: none;
        }

        .mZipcode .zipList td {
            padding: 8px 0 7px;
            line-height: 140%;
        }

        .mZipcode .zipList tr:hover,
        .mZipcode .zipList tr.selected {
            cursor: pointer;
            background-color: #e3e7f0;
        }

        .mZipcode .zipList .center {
            text-align: center;
        }

        .mZipcode .zipList .left {
            padding-left: 10px;
            text-align: left;
        }

        .mZipcode .zipList .address li {
            overflow: hidden;
        }

        .mZipcode .zipList .address p {
            padding: 0 0 0 45px;
        }

        .mZipcode .zipList .address .icoNumber,
        .mZipcode .zipList .address .icoStreet {
            float: left;
            overflow: hidden;
            width: 38px;
            height: 14px;
            margin: 1px 0 0 0;
            font-size: 0;
            line-height: 0;
            background-image: url("//img.echosting.cafe24.com/suio/sfix_zipcode.png");
            background-repeat: no-repeat;
            vertical-align: middle;
        }

        .mZipcode .zipList .address .icoNumber {
            background-position: 0 0;
        }

        .mZipcode .zipList .address .icoStreet {
            background-position: -48px 0;
        }

        .mZipcode .zipList .empty td {
            padding: 30px 0;
            cursor: default;
            text-align: center;
            background-color: #fff;
        }

        .mZipcode .zipList.street {
            height: 140px;
        }

        .mZipcode .zipList.building {
            height: 179px;
        }

        /* Tab */
        .zipCodeArea .mTab.typeTab {
            outline: 0;
        }

        /* mList */
        .mTooltip .content > p.empty {
            margin: 10px 0 0;
            padding: 0 0 0 5px;
            border: 0;
            text-align: left;
            font-size: 11px;
            letter-spacing: 0;
            color: #898989;
            outline: 0;
        }

        .mTooltip .content > p.empty:before {
            display: none;
        }

        /* 합계 - 내용 */
        .mTotalArea {
            overflow: hidden;
            margin: 10px 0 0;
            padding: 15px;
            border: 1px solid #d9dadc;
            background-color: #fff;
        }

        .mTotalArea .gLeft {
            float: left;
        }

        .mTotalArea .gLeft .item {
            margin-right: 10px;
        }

        .mTotalArea .gRight {
            float: right;
            clear: right;
        }

        .mTotalArea .gRight .item {
            margin-left: 10px;
        }

        .mTotalArea .item,
        .mTotalArea dl {
            background: url("//img.echosting.cafe24.com/suio/sflex_total_area.png") no-repeat;
        }

        .mTotalArea .item {
            float: left;
            padding: 0 0 0 20px;
            color: #454545;
            background-position: -10px -43px;
        }

        .mTotalArea dl {
            text-align: right;
            padding: 1px 18px 0 0;
            background-position: right -43px;
        }

        .mTotalArea dt {
            position: relative;
            height: 20px;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 20px;
        }

        .mTotalArea dd {
            display: inline-block;
            height: 32px;
            font-size: 16px;
            font-family: Verdana, Gulim;
            font-weight: bold;
            letter-spacing: -1px;
            line-height: 32px;
        }

        html:lang(ja) .mTotalArea dd {
            font-family: Verdana, Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
        }

        html:lang(vi) .mTotalArea dd {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mTotalArea dd {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        /* a*/
        .mTotalArea .item.a {
            padding-left: 52px;
            background-position: -10px -105px;
        }

        /* b */
        .mTotalArea .item.b {
            padding-left: 80px;
            background-position: -10px -167px;
        }

        /* total */
        .mTotalArea .item.c {
            padding-left: 78px;
            color: #348ae2;
            background-position: -10px -229px;
        }

        .mTotalArea .item.c dl {
            background-position: right -229px;
        }

        /* desc */
        .mTotalArea .desc {
            clear: both;
            width: 100%;
            padding: 10px 0 0;
            margin: 0 0 -15px -15px;
        }

        .mTotalArea .desc p {
            width: 100%;
            padding: 5px 15px;
            text-align: right;
            background: #eee;
        }

        /* 합계 - 아이콘 */
        .icoTotal {
            display: inline-block;
            width: 19px;
            height: 19px;
            font-size: 0;
            line-height: 0;
            color: transparent;
            vertical-align: middle;
            background: url("//img.echosting.cafe24.com/suio/sflex_total_area.png") no-repeat;
        }

        .icoTotal.a {
            background-position: -10px -10px;
        }

        .icoTotal.b {
            background-position: -39px -10px;
        }

        .icoTotal.c {
            background-position: -68px -10px;
        }

        /* 합계 - 테마1 */
        .mTotalArea.theme1 {
            padding: 0;
            border: 0;
        }

        .mTotalArea.theme1 table {
            border-top: 2px solid #7f7f7f;
            border-bottom: 1px solid #7f7f7f;
        }

        .mTotalArea.theme1 th {
            padding: 12px 18px 11px;
            border-left: 1px solid #e4e4e4;
            font-weight: normal;
            color: #666;
            text-align: left;
            letter-spacing: -0.04em;
            background: #f9f9f9;
        }

        .mTotalArea.theme1 td {
            border-top: 1px solid #e4e4e4;
            border-left: 1px solid #e4e4e4;
            font-weight: bold;
            font-size: 22px;
            color: #000;
            text-align: right;
            letter-spacing: -0.02em;
        }

        .mTotalArea.theme1 th:first-child,
        .mTotalArea.theme1 td:first-child {
            border-left: 0;
        }

        .mTotalArea.theme1 .item {
            float: none;
            position: relative;
            padding: 22px 29px 31px;
            line-height: 1.2;
            text-align: right;
            word-break: break-all;
            background: none;
        }

        html:lang(ja) .mTotalArea.theme1 .item {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mTotalArea.theme1 .item {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mTotalArea.theme1 .item {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mTotalArea.theme1 .item:before {
            content: '';
            position: absolute;
            top: 50%;
            left: -15px;
            width: 30px;
            height: 30px;
            margin-top: -17px;
        }

        .mTotalArea.theme1 .item.add:before {
            background: url("//img.echosting.cafe24.com/suio/sfix_total_area.png") 0 -50px;
        }

        .mTotalArea.theme1 .item.total:before {
            background: url("//img.echosting.cafe24.com/suio/sfix_total_area.png") -50px -50px;
        }

        .mTotalArea.theme1 .item.total {
            color: #1b87d4;
        }

        .mTotalArea.theme1 .desc {
            margin: 0;
            padding: 0;
        }

        .mTotalArea.theme1 .desc p {
            padding: 12px 0;
            color: #666;
            letter-spacing: -0.04em;
            background: none;
        }

        .mTotalArea .icoTotal {
            margin: 0 2px;
            background: url("//img.echosting.cafe24.com/suio/sfix_total_area.png");
        }

        .mTotalArea .icoTotal.a {
            background-position: 0 0;
        }

        .mTotalArea .icoTotal.b {
            background-position: -50px 0;
        }

        .mTotalArea .icoTotal.c {
            background-position: -100px 0;
        }

        /* mCustomer */
        .mCustomer {
            margin: 20px 0;
        }

        .mCustomer:after {
            content: "";
            display: block;
            clear: both;
        }

        .mCustomer .logo {
            float: left;
        }

        .mCustomer ul.number {
            float: left;
        }

        .mCustomer li {
            position: relative;
            margin: 15px 0 0;
            padding: 0 0 0 10px;
            background: url("//img.echosting.cafe24.com/smartAdmin/img/common/ico_intro_step.gif") no-repeat 0 8px;
        }

        .mCustomer ul.number li:first-child {
            margin-top: 0;
        }

        .mCustomer strong.title {
            display: block;
            padding: 4px 0 0;
            color: #464749;
        }

        .mCustomer p {
            padding: 4px 0 0;
            color: #9a9a9a;
        }

        .mCustomer p > span {
            font-weight: bold;
            font-style: normal;
        }

        .mCustomer p a {
            font-weight: normal;
        }

        .mCustomer p a span {
            font-weight: normal;
        }

        /* typeInquiry */
        .mCustomer.typeInquiry {
            overflow: hidden;
            display: table;
            table-layout: fixed;
            box-sizing: border-box;
            width: 100%;
            margin: 12px 0;
            border: 1px solid #cbcbcb;
        }

        .mCustomer.typeInquiry:after {
            content: "";
            display: block;
            clear: both;
        }

        .mCustomer.typeInquiry > li {
            position: relative;
            display: table-cell;
            min-height: 110px;
            margin: 0;
            padding: 20px;
            border-left: 1px solid #e0e0e0;
            background: none;
        }

        .mCustomer.typeInquiry > li:first-child {
            border-left: 0;
        }

        .mCustomer.typeInquiry > li:after {
            content: "";
            position: absolute;
            right: 21px;
            bottom: 21px;
            z-index: 0;
            display: inline-block;
            width: 65px;
            height: 65px;
            background: url("//img.echosting.cafe24.com/ec/common/sfix_introduce_customer.png") no-repeat 0 0;
        }

        .mCustomer.typeInquiry > li.inquiry:after {
            background-position: -100px -100px;
        }

        .mCustomer.typeInquiry > li.faq:after {
            background-position: -200px -200px;
        }

        .mCustomer.typeInquiry > li.manual:after {
            background-position: -300px -300px;
        }

        .mCustomer.typeInquiry > li .title {
            display: block;
            margin: 0 0 15px;
            font-size: 16px;
            color: #333;
        }

        .mCustomer.typeInquiry > li .number {
            display: inline-block;
            margin: 0 0 5px;
            font-size: 18px;
            color: #579ee5;
            line-height: 1;
        }

        .mCustomer.typeInquiry > li .desc {
            margin: 2px 0 0;
            font-size: 12px;
            line-height: 1.5;
            color: #555;
        }

        html:lang(ko) .mCustomer.typeInquiry > li .desc {
            font-size: 13px;
        }

        .mCustomer.typeInquiry > li .time {
            display: block;
            font-size: 11px;
            letter-spacing: 0;
            color: #808080;
        }

        .mCustomer.typeInquiry > li .btnDownload {
            margin: 0 0 6px;
            padding: 10px 38px 10px 12px;
            font-size: 13px;
            font-weight: normal;
        }

        .mCustomer.typeInquiry > li .btnDownload:after {
            right: 12px;
            top: 11px;
            width: 15px;
            height: 14px;
            background-position: -150px 0;
        }

        .mCustomer.typeInquiry.grid1 > li {
            width: 100%;
            min-height: 63px;
            padding: 25px 30px 27px;
        }

        .mCustomer.typeInquiry.grid2 > li {
            width: 50%;
            padding-bottom: 34px;
        }

        .mCustomer.typeInquiry.grid3 > li {
            width: 33.3%;
        }

        .mCustomer.typeInquiry.grid4 > li {
            width: 25%;
        }

        .mCustomer.typeInquiry.grid1 > li .time,
        .mCustomer.typeInquiry.grid2 > li .time {
            display: inline-block;
        }

        .mCustomer.typeInquiry.grid1 > li:after {
            top: 50%;
            margin-top: -32px;
        }

        .mCustomer.typeInquiry.grid1 > li:after {
            right: 47px;
        }

        .mCustomer.typeInquiry.grid1 > li .number {
            margin-bottom: 0;
            font-size: 26px;
        }

        .mCustomer.typeInquiry.grid1 > li .time {
            margin: 7px 0 0 10px;
            vertical-align: top;
            font-size: 13px;
            color: #555;
        }

        .mCustomer.typeInquiry.grid1 > li .time:before {
            content: "";
            display: inline-block;
            margin: 0 10px 0 0;
            vertical-align: -2px;
            width: 1px;
            height: 12px;
            background: #e0e0e0;
        }

        .mCustomer.typeInquiry.grid3 > li.manual:after,
        .mCustomer.typeInquiry.grid4 > li.manual:after {
            background: none;
        }

        /* mStep */
        .mStep {
            position: relative;
            width: 758px;
            height: 101px;
            margin: 20px 0;
            border: 1px solid #ddd;
            border-top: 0;
            background-color: #fbfbfb;
        }

        .mStep .step {
            position: absolute;
            left: -1px;
            top: 0;
            width: 100%;
            height: 50px;
            padding: 0 2px 0 0;
        }

        .mStep .step li {
            font-size: 0;
            line-height: 0;
            color: transparent;
        }

        .mStep .step ol {
            position: absolute;
            margin-top: -10px;
        }

        .mStep .step ol li {
            padding: 0 0 0 10px;
            color: #808082;
            font-size: 12px;
            line-height: 1.5;
            background: url("//img.echosting.cafe24.com/suio/sflex_notice.png") no-repeat -247px -292px;
        }

        html:lang(ja) .mStep .step ol li {
            font-family: Verdana, Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
        }

        html:lang(vi) .mStep .step ol li {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mStep .step ol li {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        /* mTerm */
        .mTerm {
            overflow: hidden;
            padding: 10px 10px 0;
            border: 1px solid #bbc0c4;
        }

        .mTerm .check {
            min-height: 14px;
            padding: 10px;
            margin: -10px -10px 5px;
            border-bottom: 1px solid #bbc0c4;
            background: #f5f4f4;
        }

        .mTerm .box {
            margin: 10px 0;
        }

        .mTerm[class*="grid"] .box {
            float: left;
        }

        .mTerm.grid2 .box {
            width: 50%;
        }

        .mTerm.grid3 .box {
            width: 33.3%;
        }

        .mTerm .box h3 {
            font-size: 12px;
            padding: 0 5px 2px;
        }

        html:lang(ko) .mTerm .box h3 {
            font-size: 13px;
        }

        .mTerm .box .term {
            margin: 5px;
            border: 1px solid #d9dadc;
        }

        .mTerm .box .term.text {
            padding: 10px;
            overflow-y: auto;
            height: 130px;
            line-height: 1.6em;
        }

        .mTerm .box .term.text li {
            margin: 0 0 3px;
        }

        .mTerm .box .term.text li label {
            min-width: 400px;
        }

        .mTerm .box.gToggle .term {
            margin: 0;
        }

        .mTerm .box iframe {
            width: 100%;
            height: 223px;
        }

        .mTerm .box .gSingle {
            padding: 0 0 0 7px;
        }

        .mTerm .head {
            min-height: 14px;
            padding: 7px 10px;
            margin: -10px -10px 5px;
            border-bottom: 1px solid #bbc0c4;
            background: #f5f4f4;
        }

        .mTerm .head .title {
            display: inline-block;
            line-height: 22px;
            font-size: 12px;
        }

        html:lang(ko) .mTerm .head .title {
            font-size: 13px;
        }

        .mTerm .head .btnNormal {
            float: right;
        }

        .mTerm.typeToggle {
            padding-bottom: 10px;
            margin: 0 0 15px;
        }

        /* mProcessBar */
        .mProcessBar {
            overflow: hidden;
            height: 42px;
            margin: 10px 0;
            border: 1px solid #cacaca;
            background: #f8f8f8;
        }

        .mProcessBar .process {
            display: table;
            position: relative;
            z-index: 1;
            width: 100%;
            margin: -1px 0;
            padding: 0 28px 0 0;
            box-sizing: border-box;
        }

        .mProcessBar .process:after {
            content: '';
            display: block;
            clear: both;
        }

        .mProcessBar .process li {
            display: table-cell;
            position: relative;
            min-width: 206px;
            height: 44px;
            margin-left: -1px;
            padding: 0 38px 0 18px;
            font-size: 14px;
            line-height: 18px;
            color: #1c1c1c;
            box-sizing: border-box;
            word-break: break-all;
            vertical-align: middle;
        }

        html:lang(ja) .mProcessBar .process li {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mProcessBar .process li {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif
        }

        html:lang(en) .mProcessBar .process li {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif
        }

        .mProcessBar .process li:first-child {
            padding-left: 28px;
        }

        .mProcessBar .process li:after,
        .mProcessBar .process li.selected:before {
            content: '';
            position: absolute;
            top: 0;
            width: 20px;
            height: 44px;
            background-image: url("//img.echosting.cafe24.com/suio/sfix_process_bar.png");
            background-repeat: no-repeat;
        }

        .mProcessBar .process li:after {
            right: 0;
        }

        .mProcessBar .process li.selected:after {
            background-position: 0 -50px;
        }

        .mProcessBar .process li.selected:before {
            left: -20px;
            background-position: 0 -100px;
        }

        .mProcessBar .process li.selected:first-child:before {
            display: none;
        }

        .mProcessBar .process li.selected {
            color: #fff;
            background: #404f6a;
        }

        /* gFix */
        .mProcessBar.gFix .process {
            display: -webkit-flex;
            display: -ms-flex;
            display: flex;
        }

        .mProcessBar.gFix .process li {
            display: -webkit-flex;
            display: -ms-flex;
            display: flex;
            -webkit-align-items: center;
            -ms-align-items: center;
            align-items: center;
            -webkit-flex: 1;
            -ms-flex: 1;
            flex: 1;
            float: left;
            min-width: inherit;
        }

        /* mProcess */
        /* typeSingle */
        .mProcess.typeSingle {
            margin: 10px 0;
        }

        .mProcess.typeSingle p {
            border-right: 1px solid #cfcfcf;
            background: url("//img.echosting.cafe24.com/suio/bg_process_single.gif") repeat-x 0 0;
        }

        /* typeInfo */
        .mProcess.typeInfo {
            margin: 10px 0 0;
        }

        .mProcess.typeInfo p {
            border-right: 1px solid #cfcfcf;
            background: url("//img.echosting.cafe24.com/suio/bg_process_single.gif") repeat-x 0 0;
        }

        .mProcess.typeInfo .info {
            padding: 24px 0 23px;
            text-align: center;
            border: 1px solid #dcdcdc;
            border-top: 0;
        }

        .mProcess.typeInfo .info .title {
            font-size: 14px;
            color: #1b87d4;
        }

        .mProcess.typeInfo .info .text {
            margin: 3px 0 0;
            border: 0;
            font-size: 12px;
            line-height: 23px;
            background: none;
        }

        html:lang(ko) .mProcess.typeInfo .info .text {
            font-size: 13px;
        }

        /* mToggleBar */
        .mToggleBar {
            margin: 0 0 -1px 0;
            border: 1px solid #d9dadc;
            background-color: #fff;
        }

        .mToggleBar:after {
            content: "";
            display: block;
            clear: both;
        }

        .mToggleBar h2 {
            float: left;
            padding: 0 0 0 8px;
            font-size: 14px;
            line-height: 44px;
            color: #1b1e26;
        }

        .mToggleBar .gLabel .fChk {
            vertical-align: middle;
        }

        .mToggleBar .ctrl {
            float: right;
        }

        .mToggleBar .ctrl .gLabel {
            margin: 15px 0 0;
            padding: 0;
        }

        .mToggleBar .gLabel input[type="checkbox"] {
            display: inline-block;
            width: 14px;
            height: 14px;
            margin: -1px 0 0;
            outline: none;
            background-image: url('//img.echosting.cafe24.com/ec/v2/sfix_icon_form.png');
            background-repeat: no-repeat;
            -webkit-appearance: none;
            appearance: none;
        }

        .mToggleBar .gLabel input[type="checkbox"]:checked,
        .mToggleBar .selected input[type="checkbox"] {
            background-position: -50px 0;
        }

        .mToggleBar .gLabel input[type="checkbox"]:disabled {
            background-position: -100px 0;
        }

        .mToggleBar .selected input[type="checkbox"]:disabled,
        .mToggleBar .disabled input[type="checkbox"] {
            background-position: -150px 0;
        }

        .mToggleBar .ctrl span {
            display: inline-block;
            position: relative;
            width: 24px;
            height: 24px;
            margin: 8px 8px 0 0;
            vertical-align: top;
        }

        /* .mToggleBar .ctrl span button { display:inline-block; position:relative; overflow:visible; width:36px; height:36px; margin:0; padding:0; border:0; font-size:0; line-height:0; vertical-align:top; background:url("//img.echosting.cafe24.com/ec/product/sfix_btn.png") no-repeat -120px 0; } */
        .mToggleBar .ctrl span button {
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            width: 24px;
            height: 24px;
            font-size: 1px;
            line-height: 0;
            color: transparent;
            white-space: nowrap;
            text-indent: 150%;
            -webkit-transition: transform linear 0.2s;
            -moz-transition: transform linear 0.2s;
            -ms-transition: transform linear 0.2s;
            transition: transform linear 0.2s;
        }

        .mToggleBar .ctrl span button em {
            overflow: hidden;
            position: absolute;
            top: 4px;
            left: 7px;
            width: 8px;
            height: 8px;
            border-width: 0 1px 1px 0;
            border-style: solid;
            border-color: #1b1e26;
            font-size: 1px;
            line-height: 0;
            color: transparent;
            white-space: nowrap;
            text-Indent: 150%;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        /* .mToggleBar.selected { border:1px solid #515565; background-color:#848898; }
    .mToggleBar.selected h2 { color:#fff; }
    .mToggleBar.selected .gLabel { color:#fff; }
    .mToggleBar.selected .ctrl span button { background-position:-120px -46px; }*/
        .mToggleBar.selected .ctrl span button {
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .mToggleBar.selected input[type="checkbox"] {
            background-position: 0 0;
        }

        /* mToggleBar theme1 */
        .mToggleBar.theme1 {
            border-color: #d1d1d1;
            background: #e6e6e6;
        }

        .mToggleBar.theme1 h2 {
            color: #1c1c1c;
        }

        .mToggleBar.theme1 .gLabel {
            color: #1c1c1c;
        }

        .mToggleBar.theme1 .ctrl span {
            background-color: #e6e6e6;
        }

        .mToggleBar.theme1 .ctrl span button {
            background: none;
        }

        .mToggleBar.theme1 .ctrl span button em {
            display: block;
            position: relative;
            width: 12px;
            height: 8px;
            margin: 0 auto;
            background-image: url("//img.echosting.cafe24.com/suio/sfix_togglebar.png");
            background-position: 0 0;
            background-repeat: no-repeat;
        }

        .mToggleBar.theme1.selected .ctrl span button em {
            background-position: -20px 0;
        }

        /* bubbleArea */
        .bubbleArea {
            position: relative;
        }

        .bubbleArea .mAutoDrop {
            display: none;
            z-index: 101;
            overflow: hidden;
            overflow-y: auto;
            max-height: 72px;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            margin: -11px 0 0;
            padding: 0 0 8px;
            border: 1px solid #d6dae1;
            border-radius: 0 0 4px 4px;
            background-color: #fff;
        }

        .bubbleArea.eAuto .mAutoDrop {
            display: block;
        }

        .bubbleArea .mAutoDrop li {
            margin-top: 0;
        }

        .bubbleArea .mAutoDrop li > a {
            display: block;
            padding: 5px 8px;
        }

        .bubbleArea .mAutoDrop li > a:hover {
            text-decoration: none;
            background-color: #f4f9ff;
        }

        /* mBubble */
        .mBubble {
            display: -webkit-flex;
            display: -ms-flex;
            display: -moz-flex;
            display: flex;
            position: relative;
            -webkit-align-items: flex-start;
            -ms-align-items: flex-start;
            -moz-align-items: flex-start;
            align-items: flex-start;
            width: 100%;
            min-height: 44px;
        }

        .mBubble .box {
            -webkit-flex: 1;
            -ms-flex: 1;
            -moz-flex: 1;
            flex: 1;
            min-width: 0;
            border: 1px solid #d6dae1;
            border-radius: 4px;
        }

        .mBubble .button {
            width: 80px;
            padding-left: 10px;
            vertical-align: bottom;
        }

        .mBubble .button.top {
            vertical-align: top;
        }

        .mBubble ul {
            margin: 4px 7px 8px;
        }

        .mBubble ul li {
            display: inline-block;
            border: 1px solid #dce8f8;
            margin: 4px 1px 0;
            padding: 0 8px;
            border-radius: 3px;
            vertical-align: top;
            font-size: 0;
            line-height: 0;
            white-space: nowrap;
            background-color: #dce8f8;
        }

        .mBubble ul li:hover,
        .mBubble ul li.selected {
            border: 1px solid #accefc;
            background-color: #accefc;
        }

        .mBubble ul li .thumb {
            display: inline-block;
            overflow: hidden;
            width: 14px;
            height: 14px;
            margin: 7px 4px 0 0;
            vertical-align: top;
            box-sizing: border-box;
        }

        .mBubble ul li .thumb.circle {
            border-radius: 7px;
            -webkit-border-radius: 7px;
            -moz-border-radius: 7px;
        }

        .mBubble ul li .thumb img {
            max-width: 100%;
        }

        .mBubble ul li .fText,
        .mBubble ul li .fText:focus {
            display: inline-block;
            height: 26px;
            padding: 0;
            border: 0;
            vertical-align: top;
            white-space: nowrap;
            font-size: 12px;
            line-height: 26px;
            cursor: move;
            letter-spacing: -1px;
            background-color: transparent;
        }

        html:lang(ko) .mBubble ul li .fText,
        html:lang(ko) .mBubble ul li .fText:focus {
            font-size: 13px;
        }

        html:lang(ja) .mBubble ul li .fText,
        html:lang(ja) .mBubble ul li .fText:focus {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mBubble ul li .fText,
        html:lang(vi) .mBubble ul li .fText:focus {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mBubble ul li .fText,
        html:lang(en) .mBubble ul li .fText:focus {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mBubble ul li .fText::-ms-clear {
            display: none;
        }

        .mBubble ul li .btnDelete {
            display: inline-block;
            margin: 9px 0 0 3px;
            vertical-align: top;
            overflow: hidden;
            width: 8px;
            height: 8px;
            white-space: nowrap;
            text-indent: 150%;
            cursor: pointer;
            background: url("//img.echosting.cafe24.com/ec/v2/product/sfix_btn.png") -136px -87px no-repeat;
        }

        .mBubble .optionValueCtrl {
            display: none;
        }

        /* gScroll */
        .mBubble .box .gScroll {
            max-height: 80px;
            overflow: auto;
        }

        /* disabled */
        .mBubble.disabled .box {
            position: relative;
            background: #f4f5f8;
        }

        .mBubble.disabled .box:hover {
            cursor: not-allowed;
        }

        .mBubble.disabled .dimmed {
            position: absolute;
            background-color: transparent;
        }

        .mBubble.disabled ul li {
            border-color: #d6dae1;
            background-color: #e2e5ea;
        }

        .mBubble.disabled ul li .fText {
            color: #aeb4c6;
        }

        .mBubble.disabled ul li .btnDelete,
        .mBubble.disabled .txtInfo,
        .mBubble.disabled + .mAutoDrop {
            display: none;
        }

        /* mBubbles */
        .mBubbles {
            position: relative;
            width: 100%;
            min-height: 34px;
        }

        .mBubbles .box {
            border-top: 1px solid #a0a0a0;
            border-left: 1px solid #a0a0a0;
            border-bottom: 1px solid #e3e3e3;
            border-right: 1px solid #e3e3e3;
        }

        .mBubbles .box + .mBubbles {
            margin-top: 5px;
        }

        .mBubbles .box > ul {
            padding: 2px 5px;
        }

        .mBubbles .box li {
            display: inline-block;
            margin: 3px 0;
            padding: 0 6px;
            border: 1px solid #b6dcff;
            border-radius: 3px;
            vertical-align: top;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 20px;
            background: #e5f3ff;
        }

        .mBubbles .box li:hover,
        .mBubbles .box li.selected {
            border: 1px solid #4395de;
            background-color: #b7d7f5;
        }

        .mBubbles .btnDelete {
            display: inline-block;
            margin: 5px 0 0;
            vertical-align: top;
            overflow: hidden;
            width: 16px;
            height: 10px;
            white-space: nowrap;
            text-indent: 150%;
            cursor: pointer;
            outline: none;
            background: url("//img.echosting.cafe24.com/ec/product/sfix_btn.png") -130px -85px no-repeat;
        }

        .mBubbles .text {
            outline: none;
            border: none;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 20px;
            background: none;
        }

        .mBubbles span.text {
            cursor: default;
        }

        .mBubbles .txtInfo {
            line-height: 16px;
        }

        /* typeMove */
        .mBubbles.typeMove li, .mBubbles.typeMove li .text {
            cursor: move;
        }

        /* disabled */
        .mBubbles.disabled .box {
            position: relative;
            background: #f2f2f2;
        }

        .mBubbles.disabled .box:hover {
            cursor: not-allowed;
        }

        .mBubbles.disabled .dimmed {
            position: absolute;
            background-color: transparent;
        }

        .mBubbles.disabled .box li {
            border-color: #c9c9c9;
            background-color: #e5e5e5;
        }

        .mBubbles.disabled .text {
            color: #969696;
            cursor: not-allowed;
        }

        .mBubbles.disabled .btnDelete,
        .mBubbles.disabled .txtInfo,
        .mBubbles.disabled + .mAutoDrop {
            display: none;
        }

        /* typeDrop */
        .mBubbles .mAutoDrop {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 103;
            overflow: hidden;
            overflow-y: auto;
            max-height: 72px;
            margin: -21px 0 0;
            border: 1px solid #4f98e2;
            background: #fff;
        }

        .mBubbles.eAuto .mAutoDrop {
            display: block;
        }

        .mBubbles .mAutoDrop li {
            margin-top: 0;
        }

        .mBubbles .mAutoDrop li > a {
            display: block;
            padding: 0 10px;
            height: 24px;
            line-height: 24px;
        }

        .mBubbles .mAutoDrop li > a:hover {
            text-decoration: none;
            background: #ecf3fb;
        }

        .eBubbleGhost {
            display: inline-block;
            overflow: hidden;
            position: absolute;
            top: 0;
            left: 0; /*height:0;*/
            font-size: 11px;
            letter-spacing: 0;
            line-height: 20px;
            font-family: Gulim, "굴림";
            visibility: hidden;
            white-space: nowrap;
            box-sizing: content-box;
        }

        .mBubble.eBubble ul:after {
            content: '';
            display: block;
            clear: both;
        }

        .mBubble.eBubble ul li {
            float: left;
            margin: 3px 4px 0 0;
        }

        .mBubble.eBubble ul li .fText {
            width: 60px;
            min-width: 60px;
        }

        /* mDropDown */
        .mDropDown {
            position: relative;
            background: #fff;
            text-align: left;
            line-height: 1.5;
        }

        .mDropDown.gFix {
            width: 130px;
        }

        .mDropDown .value {
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 28px;
            padding: 5px 30px 5px 8px;
            border: 1px solid #d6dae1;
            border-radius: 3px;
            cursor: default;
            text-overflow: ellipsis;
            white-space: nowrap;
            box-sizing: border-box;
            background: #fff url('//img.echosting.cafe24.com/ec/v2/ico_select.png') no-repeat right 9px center;
        }

        .mDropDown .list {
            display: none;
            position: absolute;
            top: 28px;
            z-index: 2;
            width: 100%;
            padding: 0 0 5px;
            box-sizing: border-box;
            border: 1px solid #d6dae1;
            border-top: 0;
            border-radius: 0 0 4px 4px;
            background-color: #fff;
        }

        .mDropDown .list li a {
            position: relative;
            display: block;
            padding: 5px 8px 5px 46px;
        }

        .mDropDown .list li a:hover {
            text-decoration: none;
            cursor: default;
            background-color: #f4f9ff;
        }

        .mDropDown .list a:before {
            position: absolute;
            top: 7px;
            left: 8px;
        }

        .mDropDown .value:before, .mDropDown .list a:before {
            content: "";
            display: inline-block;
            width: 26px;
            height: 15px;
            vertical-align: top;
            background: url("//img.echosting.cafe24.com/suio/sfix_dropdown.png") no-repeat;
        }

        .mDropDown .preview:before, .mDropDown .list a.preview:before {
            background-position: -50px 0;
        }

        .mDropDown .button:before, .mDropDown .list a.button:before {
            background-position: -100px 0;
        }

        .mDropDown .input:before, .mDropDown .list a.input:before {
            background-position: -150px 0;
        }

        .mDropDown .number:before, .mDropDown .list a.number:before {
            background-position: -200px 0;
        }

        .mDropDown .radio:before, .mDropDown .list a.radio:before {
            background-position: -250px 0;
        }

        .mDropDown .length:before, .mDropDown .list a.length:before {
            background-position: 0 -50px;
        }

        .mDropDown .area:before, .mDropDown .list a.area:before {
            background-position: -50px -50px;
        }

        .mDropDown .weight:before, .mDropDown .list a.weight:before {
            background-position: -100px -50px;
        }

        .mDropDown .volume:before, .mDropDown .list a.volume:before {
            background-position: -150px -50px;
        }

        .mDropDown .value:before {
            margin: 1px 6px 0 0;
        }

        .mDropDown .value.default:before {
            display: none;
        }

        .mDropDown .value.disabled {
            color: inherit;
            opacity: 0.5;
            filter: alpha(opacity=50);
        }

        .mDropDown.show .value {
            border: 1px solid #799bd2;
        }

        .mDropDown.show .list {
            display: block;
        }

        .mDropDown select {
            overflow: hidden;
            position: absolute;
            z-index: -1;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        /* scheduleArea */
        .scheduleArea {
            border: 1px solid #d9dadc;
        }

        .scheduleArea .mPeriod.typeSchedule {
            position: relative;
            border-bottom: 1px solid #fefefe;
            background: #f4f4f6 url("//img.echosting.cafe24.com/suio/bg_schedule_header.gif") repeat-x 0 0;
        }

        .scheduleArea .mPeriod.typeSchedule .gLeft {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .scheduleArea .mPeriod.typeSchedule .view {
            display: inline-block;
            font-size: 0;
            line-height: 0;
            vertical-align: middle;
        }

        .scheduleArea .mPeriod.typeSchedule .view a {
            display: inline-block;
            width: 26px;
            height: 22px;
            padding: 0;
            vertical-align: top;
            border: 0;
            cursor: pointer;
            background: url("//img.echosting.cafe24.com/suio/sfix_schedule.png") no-repeat;
        }

        .scheduleArea .mPeriod.typeSchedule .view .calendar {
            background-position: 0 -32px;
        }

        .scheduleArea .mPeriod.typeSchedule .view .calendar.selected {
            background-position: 0 0;
        }

        .scheduleArea .mPeriod.typeSchedule .view .list {
            width: 27px;
            background-position: -26px 0;
        }

        .scheduleArea .mPeriod.typeSchedule .view .list.selected {
            background-position: -26px -32px;
        }

        .scheduleArea .mPeriod.typeSchedule .gRight {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .scheduleArea .mPeriod.typeSchedule .date {
            padding: 20px 0;
            text-align: center;
            font-size: 0;
            line-height: 0;
        }

        .scheduleArea .mPeriod.typeSchedule .date .now {
            margin: 0 8px;
            font-weight: bold;
            vertical-align: middle;
            line-height: 20px;
            color: #313131;
            font-family: verdana;
            font-size: 16px;
        }

        .scheduleArea .mPeriod.typeSchedule .date button {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin: 0 2px;
            padding: 0;
            vertical-align: middle;
            border: 0;
            cursor: pointer;
            background: url("//img.echosting.cafe24.com/suio/sfix_schedule.png") no-repeat;
        }

        .scheduleArea .mPeriod.typeSchedule .date button span {
            position: absolute;
            overflow: hidden;
            width: 0;
            height: 0;
            font-size: 0;
            line-height: 0;
            visibility: hidden;
        }

        .scheduleArea .mPeriod.typeSchedule .date .btnPrevYear {
            background-position: -63px 0;
        }

        .scheduleArea .mPeriod.typeSchedule .date .btnPrevMonth {
            background-position: -93px 0;
        }

        .scheduleArea .mPeriod.typeSchedule .date .btnNextYear {
            background-position: -153px 0;
        }

        .scheduleArea .mPeriod.typeSchedule .date .btnNextMonth {
            background-position: -123px 0;
        }

        /* OLD */
        .scheduleArea .typeHead {
            position: relative;
            border-bottom: 1px solid #fefefe;
            background: #f4f4f6 url("//img.echosting.cafe24.com/suio/bg_schedule_header.gif") repeat-x 0 0;
        }

        .scheduleArea .typeHead .gLeft {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .scheduleArea .typeHead .view {
            display: inline-block;
            font-size: 0;
            line-height: 0;
            vertical-align: middle;
        }

        .scheduleArea .typeHead .view a {
            display: inline-block;
            width: 26px;
            height: 22px;
            padding: 0;
            vertical-align: top;
            border: 0;
            cursor: pointer;
            background: url("//img.echosting.cafe24.com/suio/sfix_schedule.png") no-repeat;
        }

        .scheduleArea .typeHead .view .calendar {
            background-position: 0 -32px;
        }

        .scheduleArea .typeHead .view .calendar.selected {
            background-position: 0 0;
        }

        .scheduleArea .typeHead .view .list {
            width: 27px;
            background-position: -26px 0;
        }

        .scheduleArea .typeHead .view .list.selected {
            background-position: -26px -32px;
        }

        .scheduleArea .typeHead .gRight {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .scheduleArea .typeHead .date {
            padding: 20px 0;
            text-align: center;
            font-size: 0;
            line-height: 0;
        }

        .scheduleArea .typeHead .date .now {
            margin: 0 8px;
            font-weight: bold;
            vertical-align: middle;
            line-height: 20px;
            color: #313131;
            font-family: verdana;
            font-size: 16px;
        }

        .scheduleArea .typeHead .date button {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin: 0 2px;
            padding: 0;
            vertical-align: middle;
            border: 0;
            cursor: pointer;
            background: url("//img.echosting.cafe24.com/suio/sfix_schedule.png") no-repeat;
        }

        .scheduleArea .typeHead .date button span {
            position: absolute;
            overflow: hidden;
            width: 0;
            height: 0;
            font-size: 0;
            line-height: 0;
            visibility: hidden;
        }

        .scheduleArea .typeHead .date .btnPrevYear {
            background-position: -63px 0;
        }

        .scheduleArea .typeHead .date .btnPrevMonth {
            background-position: -93px 0;
        }

        .scheduleArea .typeHead .date .btnNextYear {
            background-position: -153px 0;
        }

        .scheduleArea .typeHead .date .btnNextMonth {
            background-position: -123px 0;
        }

        .scheduleArea .mSchedule {
            margin: 0 -1px -1px;
        }

        .scheduleArea .mSchedule thead th {
            padding: 8px 0 7px;
            color: #313131;
            font-weight: bold;
            text-align: center;
            border: 1px solid #bbc0c4;
            border-bottom-width: 2px;
            background: #dbe0e4 url("//img.echosting.cafe24.com/suio/bg_schedule_th.gif") repeat-x 0 0;
        }

        .scheduleArea .mSchedule .left {
            text-align: left;
        }

        .scheduleArea .mSchedule .center {
            text-align: center;
        }

        .scheduleArea .mSchedule .right {
            text-align: right;
        }

        /* 캘린더형 보기 */
        .scheduleArea .mSchedule.typeCalendar thead th.sunday {
            color: #ff0000;
        }

        .scheduleArea .mSchedule.typeCalendar tbody td {
            height: 94px;
            padding: 10px 5px;
            vertical-align: top;
            color: #626262;
            border: 1px solid #d9dadc;
        }

        .scheduleArea .mSchedule.typeCalendar tbody td .day {
            display: block;
            margin: 0 0 4px;
            color: #626262;
            font-family: verdana;
            font-size: 11px;
            letter-spacing: 0;
        }

        .scheduleArea .mSchedule.typeCalendar tbody td.saturday,
        .scheduleArea .mSchedule.typeCalendar tbody td.sunday {
            background-color: #f9f9f9;
        }

        .scheduleArea .mSchedule.typeCalendar tbody td.sunday .day {
            color: #ff0000;
        }

        .scheduleArea .mSchedule.typeCalendar tbody td.today {
            border-width: 2px;
            border-color: #f9eb8a;
            background-color: #ffffd9;
        }

        .scheduleArea .mSchedule.typeCalendar tbody td.selected {
            border-width: 2px;
            border-color: #aed3f7;
            background-color: #e6f2fb;
        }

        .scheduleArea .mSchedule.typeCalendar tbody td.other .day {
            opacity: 0.5;
            filter: alpha(opacity=50);
        }

        .scheduleArea .mSchedule.typeCalendar tbody td .list li {
            width: 100%;
            overflow: hidden;
            margin: 0 0 3px;
            height: 1.3em;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .scheduleArea .mSchedule.typeCalendar tbody td .list a {
            color: #626262;
            white-space: nowrap;
        }

        /* 리스트형 보기 */
        .scheduleArea .mSchedule.typeList thead th span {
            font-weight: normal;
        }

        .scheduleArea .mSchedule.typeList tbody td {
            padding: 6px 10px;
            vertical-align: top;
            color: #626262;
            border: 1px solid #d9dadc;
        }

        .scheduleArea .mSchedule.typeList .date,
        .scheduleArea .mSchedule.typeList .time {
            font-size: 11px;
            letter-spacing: 0;
            font-family: Verdana;
        }

        .scheduleArea .mSchedule.typeList tbody.saturday,
        .scheduleArea .mSchedule.typeList tbody.sunday {
            background-color: #f9f9f9;
        }

        .scheduleArea .mSchedule.typeList tbody.today td.detail {
            border-right: 2px solid #f9eb8a;
        }

        .scheduleArea .mSchedule.typeList tbody.sunday td.date {
            color: #ff0000;
        }

        .scheduleArea .mSchedule.typeList tbody.today {
            border-top: 2px solid #f9eb8a;
            border-bottom: 2px solid #f9eb8a;
            background-color: #ffffd9;
        }

        .scheduleArea .mSchedule.typeList tbody.today td {
            background-color: #ffffd9;
        }

        .scheduleArea .mSchedule.typeList tbody.today td.date {
            border-left: 2px solid #f9eb8a;
        }

        .scheduleArea .mSchedule.typeList tbody.selected {
            border-top: 2px solid #aed3f7;
            border-bottom: 2px solid #aed3f7;
            background-color: #e6f2fb;
        }

        .scheduleArea .mSchedule.typeList tbody.selected td {
            background-color: #e6f2fb;
        }

        .scheduleArea .mSchedule.typeList tbody.selected td.date {
            border-left: 2px solid #aed3f7;
        }

        .scheduleArea .mSchedule.typeList tbody.selected td.detail {
            border-right: 2px solid #aed3f7;
        }

        .scheduleArea .mSchedule.typeList tbody a {
            color: #626262;
        }

        /* mFrameSet */
        .mFrameSet:after {
            content: "";
            display: block;
            clear: both;
        }

        .mFrameSet .gFrame {
            float: left;
            margin-left: 10px;
        }

        .mFrameSet .gFrame:first-child {
            margin-left: 0;
        }

        .mFrameSet.typeDivide {
            display: table;
            table-layout: fixed;
            width: 100%;
        }

        .mFrameSet.typeDivide:after {
            content: none;
        }

        .mFrameSet.typeDivide .gFrame {
            float: none;
            display: table-cell;
            margin: 0;
            padding-left: 10px;
        }

        .mFrameSet.typeDivide .gFrame:first-child {
            padding-left: 0;
        }

        .mFrameSet.typeHalf {
            display: table;
            table-layout: fixed;
            width: 100%;
        }

        .mFrameSet.typeHalf:after {
            content: none;
        }

        .mFrameSet.typeHalf .gFrame {
            float: left;
            width: 50%;
            margin: 0;
            padding-left: 10px;
            box-sizing: border-box;
        }

        .mFrameSet.typeHalf .gFrame:first-child {
            padding-left: 0;
        }

        /* mInputForm */
        .mInputForm {
            position: relative;
            display: inline-block;
            text-align: left;
        }

        .mInputForm .fText {
            padding-right: 30px;
            background-image: url("//img.echosting.cafe24.com/ec/v2/bg_searchform.png");
            background-repeat: no-repeat;
            background-position: right 50%;
        }

        .mInputForm .fText:focus {
            background-image: none;
        }

        .mInputForm .list {
            display: none;
            position: absolute;
            top: 28px;
            left: 0;
            z-index: 10;
            overflow: hidden;
            overflow-y: auto;
            width: 100%;
            max-height: 220px;
            padding: 4px 0;
            border: 1px solid #d6dae1;
            border-top: 0;
            box-sizing: border-box;
            border-radius: 0 0 4px 4px;
            background-color: #fff;
        }

        .mInputForm .list::-webkit-scrollbar,
        .mInputForm.typeCtrl .scroll::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .mInputForm .list::-webkit-scrollbar-button,
        .mInputForm.typeCtrl .scroll::-webkit-scrollbar-button {
            display: none;
        }

        .mInputForm .list::-webkit-scrollbar-thumb,
        .mInputForm.typeCtrl .scroll::-webkit-scrollbar-thumb {
            border: 0;
            border-radius: 3px;
            background-color: #e2e5ea;
        }

        .mInputForm.eAuto .list, .mInputForm.selected .list {
            display: block;
        }

        .mInputForm .list li {
            margin: 0;
        }

        .mInputForm .list > li,
        .mInputForm div.list ul > li {
            padding: 5px 8px;
        }

        .mInputForm .list > li:hover,
        .mInputForm div.list ul > li:hover {
            cursor: pointer;
            background-color: #f4f9ff;
        }

        .mInputForm div.list .title {
            display: block;
            padding: 5px 8px;
            color: #667084;
        }

        .mInputForm div.list ul + .title {
            margin: 4px 0 0;
            border-top: 1px solid #d6dae1;
        }

        .mInputForm.typeCtrl .list {
            overflow: hidden;
        }

        .mInputForm.typeCtrl .scroll {
            overflow: auto;
        }

        .mInputForm.typeCtrl .scroll {
            max-height: 145px;
            overflow: auto;
        }

        .mInputForm.typeCtrl .ctrl {
            display: block;
            padding: 8px 12px;
            text-align: right;
            box-sizing: border-box;
        }

        .mInputForm p.empty {
            padding: 10px 5px;
            border: 0;
        }

        /* 검색형 */
        .mInputForm .total {
            display: none;
            position: absolute;
            top: 21px;
            left: 0;
            z-index: 10;
            overflow: hidden;
            width: 100%;
            height: 33px;
            padding: 0 11px;
            border: 1px solid #6e92be;
            box-sizing: border-box;
            line-height: 33px;
            text-overflow: ellipsis;
            white-space: nowrap;
            background: #d7e4f5;
        }

        .mInputForm .result {
            display: none;
            position: absolute;
            top: 53px;
            left: 0;
            z-index: 10;
            overflow: hidden;
            overflow-y: auto;
            width: 100%;
            max-height: 220px;
            padding: 6px 0;
            border: 1px solid #6d92be;
            border-top-color: #c5d3e5;
            background: #fff;
            -webket-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .mInputForm .result li {
            position: relative;
            margin: 0;
            padding: 2px 11px 1px 32px;
            line-height: 18px;
        }

        .mInputForm .result li.group {
            margin: 13px 0 0;
        }

        .mInputForm .result li.group:before {
            content: "";
            position: absolute;
            top: -7px;
            left: 11px;
            right: 11px;
            display: block;
            border-top: 1px solid #d6d6d6;
        }

        .mInputForm .result li.group:first-child {
            margin-top: 0;
        }

        .mInputForm .result li.group:first-child:before {
            content: none;
            display: none;
        }

        .mInputForm .result li .fChk {
            position: absolute;
            top: 4px;
            left: 11px;
            cursor: pointer;
        }

        .mInputForm .result li label {
            cursor: pointer;
        }

        .mInputForm .result li.focus {
            background: #ececec;
        }

        .mInputForm .fText + .result {
            top: 21px;
            border-top: 1px solid #6e92be
        }

        .mInputForm.selected .total,
        .mInputForm.selected .result {
            display: block;
        }

        /* jQuery ui - multiple 개발 대응 */
        .ui-menu {
            overflow-x: hidden;
            overflow-y: auto;
            position: absolute;
            max-height: 220px;
            padding: 4px 0;
            border: 1px solid #d6dae1;
            border-top: 0;
            box-sizing: border-box;
            border-radius: 0 0 4px 4px;
            background: #fff;
        }

        .ui-menu .ui-menu-item .ui-corner-all {
            display: block;
            padding: 5px 8px;
            cursor: pointer;
            text-decoration: none;
        }

        .ui-menu .ui-menu-item .ui-corner-all:hover,
        .ui-menu .ui-menu-item .ui-state-hover {
            background: #f4f9ff;
        }

        /* inputFormArea */
        .inputFormArea {
            position: relative;
            display: inline-block;
        }

        .inputFormArea .mInputForm {
            display: none;
            position: absolute;
            left: 0;
            z-index: 1;
            min-width: 360px;
            border: 1px solid #d6dae1;
            border-radius: 3px;
            background-color: #fff;
        }

        .inputFormArea .mInputForm.selected {
            display: block;
        }

        .inputFormArea .mInputForm .function {
            padding: 8px;
            border-bottom: 1px solid #d6dae1;
        }

        .inputFormArea .mInputForm .list {
            position: static;
            border: 0;
        }

        /* thumbSelectArea */
        .thumbSelectArea .box {
            max-width: 1666px;
            padding: 8px 10px;
            border: 1px solid #dbd9dc;
            top: 10px;
        }

        .thumbSelectArea .btnExpand::-moz-focus-inner {
            padding: 0;
            border: 0;
        }

        .thumbSelectArea .btnExpand {
            position: relative;
            display: inline-block;
            height: 23px;
            line-height: 1;
            padding: 5px 32px 5px 8px;
            border-radius: 3px;
            background: #fff;
            border: 1px solid #a4a4a4;
            color: #353535;
        }

        .thumbSelectArea .btnExpand:after {
            content: "";
            position: absolute;
            right: 10px;
            top: 9px;
            display: inline-block;
            width: 0;
            height: 0;
            border-left: 3px solid transparent;
            border-right: 3px solid transparent;
            border-top: 3px solid #565656;
        }

        .thumbSelectArea .btnExpand:hover {
            color: #479aed;
            border: 1px solid #579ee5;
        }

        .thumbSelectArea .btnExpand:hover:after {
            border-top-color: #0f6fc5;
        }

        .thumbSelectArea .btnExpand + .box {
            display: none;
            margin: 10px 0 0;
        }

        .thumbSelectArea.show .btnExpand {
            color: #479aed;
            border: 1px solid #579ee5;
        }

        .thumbSelectArea.show .btnExpand:after {
            border-top: 0;
            border-bottom: 3px solid #0f6fc5;
        }

        .thumbSelectArea.show .box {
            display: block;
        }

        /* mThumbSelect */
        .mThumbSelect button::-moz-focus-inner {
            padding: 0;
            border: 0;
        }

        .mThumbSelect li {
            display: inline-block;
            width: 100px;
            height: 86px;
            margin-left: 8px;
            vertical-align: top;
            box-sizing: border-box;
            z-index: 1;
        }

        .mThumbSelect li:first-child {
            margin-left: 0;
        }

        .mThumbSelect > li > button,
        .mThumbSelect > li > label,
        .mThumbSelect > li > a {
            position: relative;
            display: block;
            line-height: 16px;
            width: 100%;
            height: 86px;
            padding: 55px 3px 3px;
            vertical-align: top;
            text-align: center;
            font-size: 12px;
            letter-spacing: -0.05em;
            outline: 0;
            text-decoration: none;
            border: 1px solid #d6dce3;
            cursor: pointer;
            -webkit-box-shadow: inset 1px 2px 5px 0 rgba(241, 243, 246, 1);
            -moz-box-shadow: inset 1px 2px 5px 0 rgba(241, 243, 246, 1);
            box-shadow: inset 1px 2px 5px 0 rgba(241, 243, 246, 1);
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        html:lang(ko) .mThumbSelect > li > a {
            font-size: 13px;
        }

        .mThumbSelect > li > button:before,
        .mThumbSelect > li > label:before,
        .mThumbSelect > li > a:before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            margin: auto;
            top: 0;
            display: inline-block;
            width: 100%;
            height: 50px;
        }

        .mThumbSelect > li > label input {
            position: absolute;
            left: 50%;
            top: 10px;
            margin: 0 0 0 -7px;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            filter: alpha(opacity=0);
            -moz-opacity: 0;
            opacity: 0;
        }

        .mThumbSelect li:hover > a,
        .mThumbSelect li > .eSelected {
            font-weight: bold;
            letter-spacing: -1px;
        }

        .mThumbSelect li > .eSelected:after,
        .mThumbSelect li:hover > button:after,
        .mThumbSelect li:hover > label:after,
        .mThumbSelect li:hover > a:after {
            content: "";
            display: inline-block;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            border-radius: 3px;
            position: absolute;
            top: 0;
            left: 0;
            border: 3px solid #4ba5ef;
        }

        /* gFull */
        .mThumbSelect.gFull {
            display: table;
            table-layout: fixed;
            width: 100%;
        }

        .mThumbSelect.gFull > li {
            display: table-cell;
            padding: 0 6px;
        }

        /* gHor */
        .mThumbSelect.gHor > li > button, .mThumbSelect.gHor > li > label, .mThumbSelect.gHor > li > a {
            padding: 3px 3px 3px 50%;
        }

        .mThumbSelect.gHor > li > button:before,
        .mThumbSelect.gHor > li > label:before,
        .mThumbSelect.gHor > li > a:before {
            width: 50%;
            height: 100%;
            bottom: 0;
            margin: auto 0;
        }

        /* disabled */
        .mThumbSelect > li.disabled > button,
        .mThumbSelect > li.disabled > label,
        .mThumbSelect > li.disabled > a {
            color: #1c1c1c;
            cursor: default;
        }

        .mThumbSelect li.disabled:hover > a,
        .mThumbSelect li.disabled > .eSelected {
            font-weight: normal;
            letter-spacing: -0.05em;
        }

        .mThumbSelect > li.disabled > button:after,
        .mThumbSelect > li.disabled > label:after,
        .mThumbSelect > li.disabled > a:after {
            content: "";
            display: inline-block;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border: 0;
            background-color: #fafafa;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
            filter: alpha(opacity=70);
            -moz-opacity: 0.7;
            opacity: 0.7;
        }

        /* mAccordion + typeButton */
        .mAccordion.typeButton {
            margin: 10px 0 0;
        }

        .mAccordion.typeButton:first-child {
            margin-top: 0;
        }

        .mAccordion.typeButton.gBorder .box {
            padding: 8px 10px;
            border: 1px solid #dbd9dc;
        }

        .mAccordion.typeButton .btnExpand::-moz-focus-inner {
            padding: 0;
            border: 0;
        }

        .mAccordion.typeButton .btnExpand {
            position: relative;
            display: inline-block;
            height: 28px;
            padding: 0 36px 0 8px;
            border-radius: 3px;
            outline: 0;
            border: 1px solid #aeb4c6;
            line-height: 26px;
            background: #fff;
        }

        .mAccordion.typeButton .btnExpand:after {
            content: "";
            position: absolute;
            right: 13px;
            top: 9px;
            display: inline-block;
            width: 4px;
            height: 4px;
            border-top: 1px solid #aeb4c6;
            border-right: 1px solid #aeb4c6;
            -webkit-transform: rotate(135deg);
            -ms-transform: rotate(135deg);
            -moz-transform: rotate(135deg);
            transform: rotate(135deg);
        }

        .mAccordion.typeButton .btnExpand:hover {
            color: #3971ff;
            border: 1px solid #3971ff;
        }

        .mAccordion.typeButton .btnExpand:hover:after {
            border-color: #3971ff;
        }

        .mAccordion.typeButton .btnExpand + .box {
            display: none;
            margin: 9px 0 0;
        }

        .mAccordion.typeButton.show .btnExpand {
            color: #3971ff;
            border: 1px solid #3971ff;
        }

        .mAccordion.typeButton.show .btnExpand:after {
            top: 12px;
            border-color: #3971ff;
            -webkit-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .mAccordion.typeButton.show .box {
            display: block;
        }

        /* mGlobalAddressForm */
        .mGlobalAddressForm .ec-address label {
            display: inline-block;
            vertical-align: middle;
        }

        .mGlobalAddressForm .ec-address input[type="check"] {
            width: 14px;
            height: 14px;
        }

        .mGlobalAddressForm .ec-address input[type="text"] {
            width: 100%;
            height: 22px;
            margin: 5px 0 0;
            padding: 0 5px;
            line-height: 22px;
            box-sizing: border-box;
            border: 1px solid #a7a7a7;
            border-right-color: #cfcfcf;
            border-bottom-color: #cfcfcf;
            outline: none;
        }

        .mGlobalAddressForm .ec-address input[type="text"]:first-child {
            margin-top: 0;
        }

        .mGlobalAddressForm .ec-address input[type="text"]:focus {
            border-color: #60a8f0;
            background-color: #f7f7f7;
        }

        .mGlobalAddressForm .ec-address select {
            width: 100%;
            height: 22px;
            margin: 5px 0 0;
            line-height: 22px;
            outline: none;
        }

        .mGlobalAddressForm .ec-address select:first-child {
            margin-top: 0;
        }

        .mGlobalAddressForm .ec-address li {
            margin: 5px 0 0;
        }

        .mGlobalAddressForm .ec-address li:first-child {
            margin-top: 0;
        }

        .mGlobalAddressForm .ec-address .ec-base-label {
            display: inline-block;
            vertical-align: middle;
        }

        .mGlobalAddressForm .ec-address .ec-address-zipcode input[type="text"] {
            width: 100px;
        }

        .mGlobalAddressForm .ec-address .displaynone {
            display: none;
        }

        /* mRanding */
        /* typeOrder */
        .mRanding.typeOrder {
            display: -webkit-flex;
            display: -ms-flex;
            display: -moz-flex;
            display: flex;
            margin: 0 0 30px;
            padding: 15px;
            border: 1px solid #d2d7dd;
            line-height: 1.5;
            background-color: #edf2f8;
        }

        .mRanding.typeOrder .content {
            -webkit-flex: 1;
            -ms-flex: 1;
            -moz-flex: 1;
            flex: 1;
        }

        .mRanding.typeOrder .btnLink {
            color: #1b87d4;
            font-size: 12px;
        }

        html:lang(ko) .mRanding.typeOrder .btnLink {
            font-size: 13px;
        }

        .mRanding.typeOrder .btnLink strong {
            font-weight: normal;
        }

        .mRanding.typeOrder .button {
            margin: 11px 0 0;
        }

        .mRanding.typeOrder .button a[class^="btn"] {
            margin: 0 0 0 16px;
        }

        .mRanding.typeOrder .btnClose {
            display: inline-block;
            position: relative;
            overflow: hidden;
            width: 15px;
            height: 14px;
            text-indent: 150%;
            font-size: 0;
            line-height: 0;
            white-space: nowrap;
        }

        .mRanding.typeOrder .btnClose:before,
        .mRanding.typeOrder .btnClose:after {
            content: "";
            position: absolute;
            top: 50%;
            left: -1px;
            width: 18px;
            height: 2px;
            background-color: #656e8b;
        }

        .mRanding.typeOrder .btnClose:before {
            -webkit-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .mRanding.typeOrder .btnClose:after {
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .mRanding.typeOrder .btnDown {
            display: inline-block;
            position: relative;
            padding: 0 23px 0 0;
            text-decoration: none;
        }

        .mRanding.typeOrder .btnDown:after {
            content: "";
            position: absolute;
            top: 0;
            right: 2px;
            width: 9px;
            height: 9px;
            border: solid #656e8b;
            border-width: 0 2px 2px 0;
            border-radius: 0 2px 2px 0;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        /* gNoMargin */
        .mRanding.typeOrder .button.gNoMargin {
            margin-top: 0;
        }

        /* ----------------------------------------- // Module  ----------------------------------------- */


        /* ----------------------------------------- Contents  ----------------------------------------- */

        /* Introduce */
        .introduce {
            margin: 0 0 0 28px;
        }

        .beta .introduce {
            margin: 0;
        }

        .introduce .mVisual {
            position: relative;
            overflow: hidden;
            height: 330px;
            border-bottom: 3px solid #64686e;
        }

        .introduce .mVisual .copy {
            position: absolute;
            top: 100px;
            left: 100%;
            width: 100%;
        }

        .introduce .mVisual p.button {
            position: absolute;
            left: 0;
            top: 240px;
        }

        .introduce .gContent {
            width: 760px;
        }

        .introduce h3 {
            margin: 45px 0 0;
            font-size: 20px;
        }

        html:lang(ko) .introduce h3 {
            letter-spacing: -1px;
        }

        html:lang(ja) .introduce h3 {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .introduce h3 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .introduce h3 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .introduce p.desc {
            margin: 9px 0 0;
            color: #9a9a9a;
            font-size: 12px;
            letter-spacing: -0.05em;
        }

        html:lang(ko) .introduce p.desc {
            font-size: 13px;
        }

        .introduce ul.desc {
            margin: 9px 0 0;
            color: #9a9a9a;
            font-size: 12px;
            letter-spacing: -0.05em;
            line-height: 1.5;
        }

        html:lang(ko) .introduce ul.desc {
            font-size: 13px;
        }

        .introduce .info {
            width: 723px;
            margin: 9px 0 0;
            padding: 30px 0 30px 35px;
            color: #797979;
            line-height: 1.5;
            border: 1px solid #e6e6e6;
            background: #fbfbfb;
        }

        .introduce .info strong {
            color: #599ee3;
        }

        .introduce .info p + p {
            margin: 5px 0 0;
        }

        .introduce .step {
            margin: 15px 0 0;
            padding: 50px 0 0;
        }

        .introduce .step ol {
            overflow: hidden;
            padding: 20px 0;
            border: 1px solid #e0e0e0;
            border-top: 0;
            color: #7c8086;
            line-height: 16px;
            font-size: 11px;
            letter-spacing: 0;
            background-color: #fbfbfb;
        }

        .introduce .step ol > li {
            float: left;
        }

        .introduce .step li strong {
            overflow: hidden;
            position: absolute;
            visibility: hidden;
            width: 0;
            height: 0;
            font-size: 0;
            line-height: 0;
        }

        .introduce .step ul li {
            padding: 0 0 0 9px;
            background: url("//img.echosting.cafe24.com/suio/ico_intro_step.gif") no-repeat 0 5px;
        }

        .introduce .introTab {
            background-color: #f2f2f2;
        }

        .introduce .introTab ul {
            zoom: 1;
            border: 1px solid #ccc;
            border-top: 0;
        }

        .introduce .introTab ul:after {
            content: "";
            display: block;
            clear: both;
        }

        .introduce .introTab li {
            float: left;
            border-right: 1px solid #c8cdd2;
        }

        .introduce .introTab li a {
            float: left;
            padding: 0 40px;
            line-height: 40px;
            color: #929292;
        }

        .introduce .introTab li.selected {
            position: relative;
            height: 41px;
            margin-bottom: -1px;
            background: #fff;
        }

        .introduce .introTab li.selected a {
            color: #444;
            font-weight: bold;
            letter-spacing: -1px;
        }

        .introduce div.faq {
            margin: 20px 0 0;
            padding: 20px 10px 20px 15px;
            border: 1px solid #e6e6e6;
            background-color: #fbfbfb;
        }

        .introduce div.faq h4 {
            padding: 0 0 0 17px;
            font-weight: bold;
            font-size: 14px;
            color: #444849;
            background: url("//img.echosting.cafe24.com/smartAdmin/img/optional/ico_phone_faq_q.gif") no-repeat 0 3px;
        }

        .introduce div.faq .answer {
            margin: 10px 0 0 20px;
            padding: 0 0 0 35px;
            color: #9a9a9a;
            line-height: 1.6;
            background: url("//img.echosting.cafe24.com/smartAdmin/img/optional/ico_phone_faq_a.gif") no-repeat 0 3px;
        }

        .introduce div.faq .answer h5 {
            margin: 15px 0 0;
            padding: 0;
            font-size: 12px;
            color: #599ee3;
        }

        html:lang(ko) .introduce div.faq .answer h5 {
            font-size: 13px;
        }

        .introduce div.faq .answer a {
            text-decoration: underline;
        }

        .introduce div.faq ul {
            margin: 5px 0 0;
        }

        .introduce div.faq ul li {
            padding: 0 0 0 10px;
            color: #444849;
            background: url("//img.echosting.cafe24.com/smartAdmin/img/common/ico_intro_faq.gif") no-repeat 0 7px;
        }

        .introduce dl.faq {
            margin: 20px 10px 20px 15px;
        }

        .introduce dl.faq dt {
            color: #464749;
            font-weight: bold
        }

        .introduce dl.faq dd {
            margin: 5px 0 15px 18px;
            color: #9a9a9a;
            line-height: 1.6;
        }

        .introduce a.btnMore {
            display: inline-block;
            overflow: hidden;
            height: 21px;
            padding: 1px 10px 0;
            line-height: 21px;
            color: #fff;
            font-size: 11px;
            letter-spacing: 0;
            text-align: center;
            font-weight: normal;
            vertical-align: middle;
            background: #6b6e77;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
        }

        .introduce a.btnMore:hover {
            text-decoration: none;
        }

        .introduce .txtDiscount {
            margin: 0 0 0 7px;
            padding: 0 0 0 25px;
            color: #1b87d4;
            background: url("//img.echosting.cafe24.com/ec/common/bg_discount.gif") no-repeat 0 2px;
        }

        .introduce .btnDirect {
            font-size: 13px;
            text-decoration: underline;
            color: #358de0;
        }

        .introduce .btnDirect:after {
            content: "";
            display: inline-block;
            width: 5px;
            height: 7px;
            margin: 0 0 0 5px;
            vertical-align: middle;
            background: url("//img.echosting.cafe24.com/ec/common/sfix_introduce_btn_icon.png") no-repeat -50px 0;
        }

        /* Submain */
        .submain {
            width: 1028px;
        }

        .submain h2 {
            margin: 50px 0 0;
        }

        .submain p.desc {
            margin: 10px 0 0;
        }

        .submain .title {
            margin: 47px 0 8px;
        }

        .submain .title:after {
            content: "";
            display: block;
            clear: both;
        }

        .submain .title h2 {
            float: left;
            margin: 0;
            padding: 0 0 0 13px;
            font-size: 13px;
            font-family: gulim, sans-serif;
            background: url("//img.echosting.cafe24.com/suio/sflex_heading.png") -446px -96px no-repeat;
        }

        html:lang(ja) .submain .title h2 {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .submain .title h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .submain .title h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .submain .title.img h2 {
            padding: 0;
            background: none;
        }

        .submain .title .btnNormal {
            float: right;
        }

        .submain .advertise {
            display: inline-block;
            margin: 1px 0 0 18px;
            color: #6bad37;
            font-size: 11px;
            letter-spacing: 0;
            font-weight: normal;
            vertical-align: top;
        }

        .submain .advertise a {
            color: #6bad37;
            font-size: 11px;
            letter-spacing: 0;
            font-weight: normal;
            letter-spacing: -1px;
            text-decoration: none;
        }

        .submain .half {
            display: inline-block;
            width: 100%;
        }

        .submain .half:after {
            content: "";
            display: block;
            clear: both;
        }

        .submain .half .flow {
            float: left;
            width: 496px;
        }

        .submain .half .reverse {
            float: right;
            width: 496px;
        }

        .submain a.btnMore {
            display: inline-block;
            overflow: hidden;
            height: 21px;
            padding: 1px 10px 0;
            line-height: 21px;
            color: #fff;
            font-size: 11px;
            letter-spacing: 0;
            text-align: center;
            font-weight: normal;
            vertical-align: middle;
            background: #6b6e77;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
        }

        .submain a.btnMore:hover {
            text-decoration: none;
        }

        .submain a.btnLink {
            padding: 0 6px 0 0;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 1.25;
            color: #898989;
            font-weight: normal;
            text-decoration: underline;
            vertical-align: middle;
            background: url("//img.echosting.cafe24.com/suio/sflex_icor.png") no-repeat 100% 2px;
        }

        .submain .guide {
            overflow: hidden;
            margin: 15px 0 0;
        }

        .submain .guide + .half {
            margin-top: 35px;
        }

        .submain .guide:after {
            content: "";
            display: block;
            clear: both;
        }

        .submain .guide li {
            float: left;
            width: 256px;
            height: 67px;
            margin: 0 0 26px;
            font-size: 0;
            text-indent: 150%;
            white-space: nowrap;
            border-left: 1px solid #e8e8e8;
        }

        .submain .guide li:first-child {
            border-left: 0;
        }

        .submain .guide li a {
            display: block;
            width: 255px;
            height: 67px;
        }

        /* mDropSelect */
        .mDropSelect {
            display: inline-block;
            position: relative;
            min-width: 130px;
            max-width: 200px;
            vertical-align: top;
        }

        .mDropSelect.gMiddle {
            vertical-align: middle;
        }

        .mDropSelect .fChk {
            margin: -1px 0 0;
        }

        .mDropSelect .value {
            overflow: hidden;
            position: relative;
            height: 28px;
            padding: 0 27px 0 7px;
            border: 1px solid #d6dae1;
            border-radius: 3px;
            line-height: 28px;
            white-space: nowrap;
            text-overflow: ellipsis;
            box-sizing: border-box;
            background: #fff;
        }

        .mDropSelect.selected .value {
            border-color: #3971ff;
        }

        .mDropSelect .btnCover {
            overflow: hidden;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            font-size: 1px;
            line-height: 0;
            color: transparent;
            text-indent: 150%;
        }

        .mDropSelect .btnCover:after {
            content: "";
            position: absolute;
            right: 8px;
            top: 50%;
            width: 8px;
            height: 5px;
            margin: -2px 0 0;
            background: url('//img.echosting.cafe24.com/ec/v2/sfix_icon_select.png') no-repeat 0 0;
        }

        .mDropSelect.selected .btnCover:after {
            background-position: 0 -5px;
        }

        .mDropSelect .value .gLabel {
            display: block;
            padding: 0 15px 0 10px;
            line-height: 25px;
            cursor: pointer;
        }

        .mDropSelect .result {
            display: none;
            overflow-x: hidden;
            overflow-y: auto;
            position: absolute;
            top: 28px;
            left: 0;
            z-index: 2;
            width: 100%;
        }

        .mDropSelect.selected .result {
            display: block;
        }

        .mDropSelect.posTop.selected .result {
            top: inherit;
            bottom: 28px;
        }

        .mDropSelect .result .list {
            border: 1px solid #d6dae1;
            border-top-color: transparent;
            border-radius: 0 0 3px 3px;
            background: #fff;
        }

        .mDropSelect.posTop.selected .result .list {
            border-top-color: #d6dae1;
            border-bottom-color: transparent;
            border-radius: 3px 3px 0 0;
        }

        .mDropSelect .result .list li {
            position: relative;
            margin: 0;
        }

        .mDropSelect .result .list li.all {
            border-bottom: 1px solid #c7d3e6;
            background: #e4e7f1;
        }

        .mDropSelect .result .list li .gLabel {
            display: block;
            margin: 0;
            padding: 7px 10px 6px;
            line-height: 18px;
            cursor: pointer;
        }

        .mDropSelect .result .list li.all .gLabel {
            color: #3788dd;
        }

        .mDropSelect .result .list li .gLabel.eSelected {
            background: #ececec;
        }

        /* typeValue */
        .mDropSelect.typeValue .value .total strong {
            color: #3971ff;
            font-weight: normal;
        }

        .mDropSelect.typeValue .result .list li .gLabel.eSelected {
            background: transparent;
        }

        /* mFileDrop */
        .mFileDrop .inner {
            position: relative;
            width: 100%;
            min-height: 70px;
            font-size: 12px;
            box-sizing: border-box;
        }

        html:lang(ko) .mFileDrop .inner {
            font-size: 13px;
        }

        .mFileDrop .inner .text {
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            text-align: center;
            -webkit-transform: translate(0, -50%);
            -moz-transform: translate(0, -50%);
            -ms-transform: translate(0, -50%);
            transform: translate(0, -50%);
        }

        /* typeEditor */
        .mFileDrop.typeEditor {
            border: 1px solid #e1e1e1;
            color: #898989;
            background: #f3f5f6;
            -webkit-box-shadow: inset 5px 5px 0 0 rgba(206, 231, 255, 1), inset -5px -5px 0 0 rgba(206, 231, 255, 1);
            -moz-box-shadow: inset 5px 5px 0 0 rgba(206, 231, 255, 1), inset -5px -5px 0 0 rgba(206, 231, 255, 1);
            box-shadow: inset 5px 5px 0 0 rgba(206, 231, 255, 1), inset -5px -5px 0 0 rgba(206, 231, 255, 1);
        }

        /* typeAttach */
        .mFileDrop.typeAttach .inner {
            margin: 0 0 15px;
            color: #898989;
            background: #fbfbfb;
            border-color: transparent;
            border-style: solid;
            border-width: 9px 9px 5px 5px;
            -moz-border-image: url("//img.echosting.cafe24.com/suio/bg_file_drop.png") 7 7 4 4 repeat;
            -webkit-border-image: url("//img.echosting.cafe24.com/suio/bg_file_drop.png") 7 7 4 4 repeat;
            -o-border-image: url("//img.echosting.cafe24.com/suio/bg_file_drop.png") 7 7 4 4 repeat;
            border-image: url("//img.echosting.cafe24.com/suio/bg_file_drop.png") 7 7 4 4 repeat;
        }

        .mFileDrop.typeAttach .attach:after {
            content: '';
            display: block;
            clear: both;
        }

        .mFileDrop.typeAttach .fFile {
            float: left;
        }

        .mFileDrop.typeAttach .txtInfo {
            float: right;
        }

        /* gFloat */
        .mFileDrop.gFloat {
            position: absolute;
            left: 0;
            right: 0;
            top: 32px;
        }

        /* ----------------------------------------- // Contents  ----------------------------------------- */


        /* ----------------------------------------- Overlay  ----------------------------------------- */

        /* mLayer */
        .mLayer {
            display: none;
            position: absolute;
            z-index: 110;
            left: 50%;
            border: 1px solid #d6dae1;
            border-radius: 4px;
            box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.1);
            line-height: 1.5;
            color: #1b1e26;
            background-color: #fff;
            box-sizing: border-box;
        }

        .mLayer > h2 {
            padding: 16px 40px 20px 16px;
            font-size: 14px;
            line-height: 20px;
            text-align: left;
        }

        .mLayer > .title {
            padding: 16px 40px 20px 16px;
            line-height: 20px;
            text-align: left;
        }

        .mLayer > .title h2 {
            display: inline-block;
            font-size: 14px;
        }

        .mLayer > .title h2 + .mTooltip {
            margin: -2px 0 0 4px
        }

        .mLayer .wrap {
            padding: 0 16px 16px;
            word-wrap: break-word;
        }

        .mLayer .wrap:after {
            content: "";
            display: block;
            clear: both;
        }

        .mLayer .wrap .mTitle:first-child {
            margin-top: 0;
        }

        .mLayer .wrap .mTitle h4 {
            font-weight: normal;
        }

        .mLayer .wrap .mTitle h3 + h4 {
            margin: 5px 0 0;
        }

        .mLayer .footer {
            padding: 9px 16px 16px;
            text-align: center;
        }

        .mLayer .footer .btnCtrl span {
            background-color: #3971ff;
        }

        .mLayer .footer .btnCtrl:hover span,
        .mLayer .footer .btnCtrl.selected span {
            background-color: #2952b8;
        }

        .mLayer .footer .btnCtrl:disabled span,
        .mLayer .footer .btnCtrl.disabled span,
        .mLayer .footer .btnCtrl:disabled:hover span,
        .mLayer .footer .btnCtrl.disabled:hover span {
            background-color: #d6dae1;
        }

        .mLayer .mBoard .empty td,
        .mLayer .mBoard p.empty,
        .mLayer .mBoard div.empty {
            padding: 40px 0;
        }

        .mLayer .btnClose {
            overflow: hidden;
            position: absolute;
            top: 16px;
            right: 16px;
            width: 16px;
            height: 16px;
            text-indent: 150%;
            font-size: 0;
            line-height: 0;
            white-space: nowrap;
        }

        .mLayer .btnClose:before,
        .mLayer .btnClose:after {
            content: "";
            position: absolute;
            top: 7px;
            left: 0;
            width: 18px;
            height: 1px;
            background-color: #667083;
        }

        .mLayer .btnClose:before {
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .mLayer .btnClose:after {
            -webkit-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .mLayer .gCenter {
            text-align: center;
        }

        .mLayer.gSmall {
            width: 430px;
        }

        .mLayer.gMedium {
            width: 520px;
        }

        .mLayer.gLarge {
            width: 820px;
        }

        /* typeIframe */
        .mLayer.typeIframe.gSmall {
            width: 430px;
            border: 0;
            box-shadow: none;
        }

        .mLayer.typeIframe.gMedium {
            width: 520px;
            border: 0;
            box-shadow: none;
        }

        .mLayer.typeIframe.gLarge {
            width: 820px;
            border: 0;
            box-shadow: none;
        }

        #iframe {
            background: none;
        }

        #iframe .mLayer {
            position: static;
            display: block;
        }

        /* mLayer#iframe */
        #iframe.mLayer {
            display: block;
            position: static;
            border: 0;
        }

        /* typeScroll */
        .mLayer.typeScroll .wrap {
            overflow: auto;
        }

        .mLayer.typeScroll .wrap + .footer {
            margin-top: 0;
        }

        /* typeSms */
        .mLayer.typeSms {
            width: 218px;
            background-color: #e5e9ec;
        }

        .mLayer.typeSms .wrap {
            padding-bottom: 5px;
        }

        /* Layer Reset */
        .mLayer .footer.check {
            padding-right: 15px;
            padding-left: 15px;
            text-align: right;
        }

        .mLayer .footer.check:after {
            content: "";
            display: block;
            clear: both;
        }

        .mLayer .footer.check .gLabel {
            float: left;
            padding-top: 4px;
            font-size: 11px;
            letter-spacing: 0;
        }

        .mLayer .mPaginate {
            margin-top: 15px;
        }

        /* mOpen */
        .mOpen {
            position: relative;
            display: inline-block;
        }

        .mOpen .open {
            display: none;
            position: absolute;
            z-index: 110;
            right: 0;
            border: 1px solid #d6dae1;
            border-radius: 4px;
            box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .mOpen .open .wrap {
            overflow: auto;
            text-align: left;
            max-height: 400px;
        }

        .mOpen .open .wrap .default {
            padding: 0;
        }

        .mOpen .open .wrap .default li {
            padding: 0;
            margin: 0;
            background: none;
        }

        .mOpen .open .wrap .default a {
            display: block;
            padding: 4px 10px 3px;
            line-height: 1.25;
            text-decoration: none;
        }

        .mOpen .open .wrap .default li.selected a,
        .mOpen .open .wrap .default a:hover {
            color: #fff;
            background-color: #96a9cc;
        }

        .mOpen .open .footer {
            padding: 24px 16px 16px;
            text-align: center;
        }

        .mOpen .open .footer .btnCtrl span {
            background-color: #3971ff;
        }

        /* 인쇄 레이어 */
        .mOpen .open .wrap .print a {
            display: block;
            padding: 4px 20px 3px 32px;
            text-decoration: none;
            background-image: url("//img.echosting.cafe24.com/ec/order/sflex_ico.png");
            background-repeat: no-repeat;
        }

        .mOpen .open .wrap .print a:hover {
            color: #fff;
            background-color: #96a9cc;
        }

        .mOpen .open .wrap .print a.order {
            background-position: -477px 4px;
        }

        .mOpen .open .wrap .print a.screen {
            background-position: -426px -95px;
        }

        .mOpen .open .wrap .print a.statement {
            background-position: -377px -196px;
        }

        .mOpen .open .wrap .print a.stats {
            background-position: -477px 4px;
        }

        /* 엑셀 다운 레이어 */
        .mOpen .open .wrap .excel a {
            display: block;
            padding: 4px 20px 3px 32px;
            text-decoration: none;
            background: url("//img.echosting.cafe24.com/ec/order/sflex_ico.png") no-repeat -326px -295px;
        }

        .mOpen .open .wrap .excel a:hover {
            color: #fff;
            background-color: #96a9cc;
        }

        /* Open Reset */
        .gGoods .mOpen {
            float: left;
        }

        .gGoods .mOpen .frame {
            cursor: pointer;
        }

        .mOpen.typeSetting .title {
            display: block;
            padding: 0 10px;
            line-height: 33px;
            text-align: left;
        }

        .mOpen.typeSetting .wrap {
            padding: 0 10px 10px;
        }

        .mOpen.typeSetting .wrap .default li {
            padding: 2px 0 0;
        }

        /* typeViewMore */
        .mOpen.typeViewMore {
            vertical-align: top;
        }

        .mOpen.typeViewMore .btnViewMore {
            display: inline-block;
            height: 28px;
            padding: 7px;
            border: 1px solid #aeb4c6;
            font-size: 12px;
            line-height: 26px;
            color: #1b1e26;
            font-weight: normal;
            background-color: #fff;
            box-sizing: border-box;
            border-radius: 3px;
        }

        html:lang(ko) .mOpen.typeViewMore .btnViewMore {
            font-size: 13px;
        }

        .mOpen.typeViewMore .btnViewMore:hover,
        .mOpen.typeViewMore .btnViewMore.selected {
            background-color: #f4f9ff;
        }

        .mOpen.typeViewMore .btnViewMore .icoBox {
            display: inline-block;
            width: 12px;
            height: 12px;
            text-align: center;
        }

        .mOpen.typeViewMore .btnViewMore .icoBox i.icoViewMore {
            position: relative;
            display: inline-block;
            vertical-align: middle;
            margin: 5px 0;
            width: 2px;
            height: 2px;
            border-radius: 1px;
            background-color: #000;
        }

        .mOpen.typeViewMore .btnViewMore .icoBox i.icoViewMore:before {
            content: "";
            position: absolute;
            left: -5px;
            width: 2px;
            height: 2px;
            border-radius: 1px;
            background-color: #000;
        }

        .mOpen.typeViewMore .btnViewMore .icoBox i.icoViewMore:after {
            content: "";
            position: absolute;
            right: -5px;
            width: 2px;
            height: 2px;
            border-radius: 1px;
            background-color: #000;
        }

        .mOpen.typeViewMore .open {
            padding: 4px 0 0;
            border: 0;
            border-radius: 0;
            box-shadow: none;
            background: none;
        }

        .mOpen.typeViewMore .open .wrap {
            position: absolute;
            z-index: 110;
            width: 100%;
            padding: 7px 0;
            right: 0;
            border: 1px solid #d6dae1;
            border-radius: 4px;
            box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .mOpen.typeViewMore .open .list li a {
            display: block;
            font-size: 13px;
            line-height: 20px;
            padding: 8px 15px;
        }

        .mOpen.typeViewMore .open .list li a:hover {
            text-decoration: none;
            background-color: #F4F9FF;
        }

        .mOpen.typeViewMore .open .list li.divide {
            border-top: 1px solid #d6dae1;
        }

        /* Dimmed */
        .dimmed {
            z-index: 102;
            position: fixed;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            opacity: 0.7;
            filter: alpha(opacity=70);
        }

        .dimmed.hide {
            background: none;
        }

        /* mTooltip (module.css 의 레이어팝업 Tooltip SUIO Type에 동시 반영 필수) */
        .cTip {
            display: inline-block;
        }

        .mTooltip {
            position: relative;
            display: inline-block;
            margin: -2px 0 0;
            text-align: left;
            vertical-align: middle;
        }

        html:lang(ja) .mTooltip {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mTooltip {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        html:lang(en) .mTooltip {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mTooltip > button,
        .mTooltip > a {
            display: block;
        }

        .mTooltip .tooltip {
            display: none;
            position: absolute;
            left: -13px;
            top: 30px;
            text-align: left;
            font-weight: normal;
            letter-spacing: normal;
            border: 1px solid #d6dae1;
            background-color: #fff;
            border-radius: 2px;
        }

        .mTooltip .close {
            position: absolute;
            right: 6px;
            top: 8px;
            overflow: hidden;
            width: 16px;
            height: 16px;
            text-indent: 150%;
            white-space: nowrap;
        }

        .mTooltip .close:before,
        .mTooltip .close:after {
            content: "";
            position: absolute;
            top: 7px;
            left: 2px;
            width: 12px;
            height: 2px;
            background-color: #667084;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .mTooltip .close:after {
            -webkit-transform: rotate(135deg);
            -moz-transform: rotate(135deg);
            -ms-transform: rotate(135deg);
            transform: rotate(135deg);
        }

        .mTooltip .edge {
            position: absolute;
            left: 14px;
            top: -7px;
            width: 9px;
            height: 6px;
            font-size: 0;
            line-height: 0;
        }

        .mTooltip .edge:after {
            content: "";
            display: inline-block;
            width: 12px;
            height: 12px;
            border-width: 1px 0 0 1px;
            border-style: solid;
            border-color: #d6dae1;
            background: #fff;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .mTooltip .content {
            padding: 16px;
        }

        .mTooltip .titleEm,
        .mTooltip .titleTip {
            display: block;
            margin: 10px 20px 8px 0;
            border-bottom: 0;
            font-size: 12px;
            color: #1b1e26;
        }

        html:lang(ko) .mTooltip .titleEm,
        html:lang(ko) .mTooltip .titleTip {
            font-size: 13px;
        }

        .mTooltip .titleEm:first-child {
            margin-top: 0;
        }

        .mTooltip .title {
            position: relative;
            display: block;
            margin: 10px 0 5px;
            padding: 0 0 0 15px;
            color: #6f6f6f;
            font-size: 11px;
            letter-spacing: 0;
            word-spacing: -1px;
        }

        .mTooltip .title:before {
            content: "";
            position: absolute;
            width: 2px;
            height: 2px;
            margin: 5px 7px 0 -9px;
            background-color: #898989;
        }

        /* 오른쪽 좌표 지정상태 */
        .mTooltip .tooltip.posRight {
            left: 18px;
        }

        .mTooltip .tooltip.posRight .edge {
            left: auto;
            right: 6px;
        }

        /* 상단 좌표 지정상태 */
        .mTooltip .tooltip.posTop {
            top: 17px;
        }

        .mTooltip .tooltip.posTop .edge {
            top: auto;
            bottom: 0;
        }

        .mTooltip .tooltip.posTop .edge:after {
            border-width: 0 1px 1px 0;
        }

        /* 아이콘 공통 */
        .mTooltip .icon {
            overflow: hidden;
            width: 14px;
            height: 14px;
            text-indent: 150%;
            white-space: nowrap;
            cursor: pointer;
            background: url('//img.echosting.cafe24.com/ec/v2/sflex_tooltip.png') no-repeat -486px 0;
        }

        .mTooltip.show .icon {
            background-position: -472px 0;
        }

        /* 아이콘 : 디자인설정안내 */
        .mTooltip.typeDesign .icon {
            width: 87px;
            height: 14px;
            background: url('//img.echosting.cafe24.com/suio/ko_KR/sfix_icon_guide.png') 0 0 no-repeat;
        }

        html:lang(vi) .mTooltip.typeDesign .icon {
            width: 140px;
            background-image: url('//img.echosting.cafe24.com/suio/vi_VN/sfix_icon_guide.png');
        }

        html:lang(en) .mTooltip.typeDesign .icon {
            width: 98px;
            background-image: url('//img.echosting.cafe24.com/suio/en_US/sfix_icon_guide.png');
        }

        /* 아이콘 : 법적고지 */
        .mTooltip.typeLaw .icon {
            width: 56px;
            height: 14px;
            background: url('//img.echosting.cafe24.com/suio/ko_KR/sfix_icon_guide.png') 0 -50px no-repeat;
        }

        html:lang(vi) .mTooltip.typeLaw .icon {
            width: 85px;
            background-image: url('//img.echosting.cafe24.com/suio/vi_VN/sfix_icon_guide.png');
        }

        html:lang(en) .mTooltip.typeLaw .icon {
            width: 97px;
            background-image: url('//img.echosting.cafe24.com/suio/en_US/sfix_icon_guide.png');
        }

        /* 시스템폰트 */
        .mTooltip .text {
            font-size: 11px;
            letter-spacing: 0;
            line-height: 16px;
            color: #667084;
            vertical-align: top;
            background: none;
        }

        /* show */
        .mTooltip.show {
            z-index: 80;
        }

        /* width */
        .mTooltip.gSmall .tooltip {
            width: 258px;
        }

        .mTooltip.gMedium .tooltip {
            width: 348px;
        }

        .mTooltip.gLarge .tooltip {
            width: 508px;
        }

        /* 이미지 미리보기 */
        .mTooltip .gPreview {
            display: table;
            table-layout: fixed;
        }

        .mTooltip .gPreview .text {
            display: table-cell;
            padding: 0 6px 10px 4px;
            vertical-align: top;
        }

        .mTooltip .gPreview .thumb {
            display: table-cell;
        }

        .mTooltip .gPreview > li {
            display: table-cell;
            padding: 0 0 0 10px;
            vertical-align: top;
        }

        .mTooltip .gPreview > li:first-child {
            padding-left: 0;
        }

        /* 예시 이미지 */
        .mTooltip .gImage {
            margin: 5px 0;
        }

        .mTooltip .gImage.center {
            text-align: center;
        }

        .mTooltip .gImage.left {
            padding-left: 15px;
        }

        /* gLabel(label)의 설명 툴팁제공 */
        .mTooltip.gLabel {
            margin: -2px 8px 0 -18px;
        }

        .mTooltip.gSingleLabel {
            margin: -2px 8px 0 -15px;
        }

        /* 스크롤 외부 생성 */
        #tooltipSCrollView {
            position: static;
            width: 0 !important;
            height: 0 !important;
            vertical-align: top;
        }

        #tooltipSCrollView .tooltip {
            position: absolute;
            z-index: 1000;
            display: block;
        }

        /* 2줄 이상 툴팁 우측 정렬 */
        .gTooltip > span,
        .gTooltip > strong {
            display: inline-block;
        }

        .mBoard th .gTooltip .mTooltip {
            margin-top: -16px;
        }

        /* 툴팁 들여쓰기 */
        .mTooltip .gIndent {
            margin-left: 15px;
        }

        /* z-index 설정*/
        .mTitle .mTooltip {
            z-index: 3;
            margin-top: 0;
        }

        /* mTip */
        .mTip {
            z-index: 2;
            position: relative;
            margin: 0 0 10px;
            text-align: right;
        }

        .headingArea .mTip {
            margin-top: -42px;
        }

        .mTitle .mTip {
            margin-top: -24px;
        }

        .mTip .btnTip {
            padding: 5px 9px;
            font-size: 12px;
            line-height: 1;
            cursor: pointer;
            border: 1px solid #a4a4a4;
            border-radius: 2px;
            color: #353535;
            background: #fff;
        }

        html:lang(ko) .mTip .btnTip {
            font-size: 13px;
        }

        .mTip .btnTip .icoTip, .mTip .btnTip .icoChart {
            display: inline-block;
            vertical-align: middle;
            background-image: url("//img.echosting.cafe24.com/ec/v2/ko_KR/sfix_icon_button2.png");
            background-repeat: no-repeat;
        }

        .mTip .btnTip .icoTip {
            margin: 0 0 0 10px;
            width: 6px;
            height: 3px;
            background-position: -100px -350px;
        }

        .mTip.show .btnTip,
        .mTip .btnTip:hover {
            color: #479aed;
            border-color: #579ee5;
        }

        .mTip.show .btnTip .icoTip,
        .mTip.show .btnTip:hover .icoTip {
            background-position: -100px -380px;
        }

        .mTip .btnTip:hover .icoTip {
            background-position: -100px -400px;
        }

        .mTip .btnTip .icoChart {
            width: 16px;
            height: 12px;
            vertical-align: top;
            background-position: -250px -500px;
        }

        .mTip.show .btnTip .icoChart,
        .mTip .btnTip:hover .icoChart {
            background-position: -300px -500px;
        }

        .mTip .close {
            overflow: hidden;
            position: absolute;
            top: 20px;
            right: 20px;
            width: 15px;
            height: 14px;
            font-size: 0;
            color: transparent;
            text-indent: 120%;
            background: url("//img.echosting.cafe24.com/suio/sflex_tip.png") -400px -100px no-repeat;
        }

        .mTip .tip {
            display: none;
            position: relative;
            margin: 10px 0 30px;
            padding: 30px;
            text-align: center;
            border: 1px solid #adbbc6;
            border-radius: 3px;
            background-color: #eff8ff;
        }

        .mTip.show .tip {
            display: block;
        }

        .mTip .content {
            display: inline-block;
            text-align: left;
            font-size: 13px;
            line-height: 1.5em;
        }

        .mTip .content .title {
            display: block;
            margin: 0 0 30px;
            font-size: 26px;
            line-height: 1;
            letter-spacing: -1px;
        }

        .mTip .content ol,
        .mTip .content ul {
            margin: 0;
            text-align: left;
        }

        .mTip .content > p {
            margin: 0;
            padding: 0;
            background: none;
        }

        .mTip .content > ul > li,
        .mTip .content > ol > li {
            margin: 30px 0 0;
            padding: 0;
            background: none;
        }

        .mTip .content > ul > li:before {
            display: inline-block;
            content: "-";
            margin: -2px 10px 0 0;
            width: 5px;
            height: 20px;
            vertical-align: middle;
        }

        .mTip .content > ol > li:first-child,
        .mTip .content > ul > li:first-child {
            margin: 0;
        }

        .mTip .content > ol > li[class^="item"]:before {
            display: inline-block;
            content: "";
            margin: -2px 10px 0 0;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            background: url('//img.echosting.cafe24.com/suio/sflex_tip.png') no-repeat;
        }

        .mTip .content > ol > li.item1:before {
            background-position: -300px -300px;
        }

        .mTip .content > ol > li.item2:before {
            background-position: -250px -400px;
        }

        .mTip .content > ol > li.item3:before {
            background-position: -200px -500px;
        }

        .mTip .content > ol > li.item4:before {
            background-position: -150px -600px;
        }

        .mTip .content > ol > li.item5:before {
            background-position: -100px -700px;
        }

        .mTip .content > ol > li .text {
            display: inline-block;
            margin: 1px 0 0 -5px;
            line-height: 17px;
            vertical-align: top;
        }

        /* typeGrid */
        .mTip.typeGrid .tip {
            padding: 45px 15px 40px;
        }

        .mTip.typeGrid .content {
            display: block;
            font-size: 12px;
        }

        html:lang(ko) .mTip.typeGrid .content {
            font-size: 13px;
        }

        .mTip.typeGrid .content ol {
            text-align: center;
        }

        .mTip.typeGrid ol > li {
            display: inline-block;
            width: 174px;
            height: 124px;
            margin: 0;
            padding: 20px 17px;
            text-align: center;
            vertical-align: top;
            background: #fff;
            border: 1px solid #cee2f6;
        }

        .mTip.typeGrid ol > li,
        .mTip.typeGrid .content > ol > li:first-child {
            margin: 0 40px 0 0;
        }

        .mTip.typeGrid .content > ol > li:last-child {
            margin: 0;
        }

        .mTip.typeGrid li[class*="item"] {
            position: relative;
        }

        .mTip.typeGrid li[class*="item"]:after {
            display: inline-block;
            content: "";
            position: absolute;
            top: 83px;
            right: -30px;
            width: 11px;
            height: 10px;
            background: url('//img.echosting.cafe24.com/suio/sflex_tip.png') no-repeat;
            background-position: -350px -200px;
        }

        .mTip.typeGrid li[class*="item"]:last-child:after {
            background-image: none;
        }

        .mTip.typeGrid li[class*="item"] .text {
            font-weight: 600;
        }

        .mTip.typeGrid li[class*="item"] .thumbnail {
            display: block;
            position: relative;
            overflow: hidden;
            width: 50px;
            height: 45px;
            margin: 13px auto;
        }

        .mTip.typeGrid li[class*="item"] .thumbnail:before {
            display: inline-block;
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 50px;
            height: 45px;
        }

        .mTip.typeGrid .item1 .thumbnail:before {
            background-position: 0 0;
        }

        .mTip.typeGrid .item2 .thumbnail:before {
            background-position: -100px 0;
        }

        .mTip.typeGrid .item3 .thumbnail:before {
            background-position: -200px 0;
        }

        .mTip.typeGrid .item4 .thumbnail:before {
            background-position: -300px 0;
        }

        .mTip.typeGrid li[class*="item"] .desc {
            display: inline-block;
            margin: 1px 0 0 -5px;
            color: #898989;
            line-height: 17px;
            vertical-align: top;
        }

        .mTip.typeGrid li[class*="item"] .desc a {
            color: #898989;
        }

        .mTip.typeGrid.gText .tip {
            padding-top: 35px;
        }

        .mTip.typeGrid.gText .content {
            display: inline-block;
        }

        .mTip.typeGrid.gText .content .title {
            margin: 0 0 20px 0;
            font-size: 13px;
        }

        .mTip.typeGrid.gText ol > li.selected {
            border: 1px solid #579ee5;
        }

        .mTip.typeGrid.gText li[class*="item"] {
            text-align: left;
        }

        .mTip.typeGrid.gText .content > ol > li .text {
            display: block;
            margin: 16px 0 0 0;
            color: #333;
        }

        .mTip.typeGrid.gText li[class*="item"] .desc {
            margin: 4px 0 17px 0;
            color: #555;
            letter-spacing: -1px;
        }

        .mTip.typeGrid.gText .txtLine {
            display: inline-block;
            position: relative;
            padding: 0 11px 0 0;
            color: #898989;
        }

        .mTip.typeGrid.gText .txtLine:after {
            display: inline-block;
            content: "";
            position: absolute;
            top: 9px;
            right: 0;
            width: 5px;
            height: 5px;
            border-left: 1px solid #898989;
            border-bottom: 1px solid #898989;
            transform: translate(0, -50%) rotate(-135deg);
            -webkit-transform: translate(0, -50%) rotate(-135deg);
        }

        /* typeLayer */
        .mTip.typeLayer .tip {
            position: absolute;
            right: 0;
            margin-bottom: 0;
        }

        .mTip.typeLayer .content {
            width: 100%;
        }

        /* mAlign */
        .mAlign li {
            display: inline-block;
            vertical-align: top;
            padding: 0 5px 0 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        /* typeCheck */
        .mAlign.typeCheck li {
            padding-left: 18px;
        }

        .mAlign.typeCheck li label .fChk {
            margin-left: -18px;
        }

        /* 고정폭 */
        .mAlign[class*="w1"], .mAlign[class*="w2"] {
            width: auto;
        }

        /* 가변폭 */
        .mAlign[class*="grid"]:after {
            content: "";
            display: block;
            clear: both;
        }

        .mAlign[class*="grid"] li {
            float: left;
        }

        .mAlign.grid2 li {
            width: 50%;
        }

        .mAlign.grid3 li {
            width: 33.3%;
        }

        .mAlign.grid4 li {
            width: 25%;
        }

        .mAlign.grid5 li {
            width: 20%;
        }

        /* mNotice */
        .mNotice {
            z-index: 110;
            position: absolute;
            left: 50%;
            width: 340px;
            margin: 0 0 0 -170px;
            text-align: left;
            background-color: #575e6a;
        }

        .mNotice .content {
            padding: 25px 15px 20px;
        }

        .mNotice .close {
            overflow: hidden;
            position: absolute;
            top: 8px;
            right: 10px;
            width: 14px;
            height: 14px;
            text-indent: 150%;
            white-space: nowrap;
            background: url("//img.echosting.cafe24.com/suio/sfix_btn.png") no-repeat 0 0;
            cursor: pointer;
        }

        .mNotice h1 {
            padding: 30px 11px 0;
            text-align: center;
        }

        .mNotice h1 span {
            display: inline-block;
            min-height: 18px;
            padding: 0 0 0 25px;
            color: #fff;
            font-size: 20px;
            line-height: 22px;
            letter-spacing: -1px;
            background: url("//img.echosting.cafe24.com/suio/sflex_notice.png") -382px 1px no-repeat;
        }

        .mNotice h2 {
            margin: 15px 0 8px;
            padding: 0 0 0 12px;
            font-size: 12px;
            background: url("//img.echosting.cafe24.com/suio/sflex_notice.png") -248px -296px no-repeat;
        }

        html:lang(ko) .mNotice h2 {
            font-size: 13px;
        }

        .mNotice h2 span {
            font-weight: normal;
        }

        .mNotice .wrap {
            padding: 25px 15px 20px;
        }

        .mNotice .point {
            color: #c5cbd4;
            line-height: 1.5;
        }

        .mNotice .point strong {
            color: #fff;
            text-decoration: underline;
            font-family: Verdana;
            word-spacing: -1px;
        }

        .mNotice .info {
            margin: 15px 0 0;
            padding: 5px 15px 10px;
            background-color: #eaeff5;
        }

        .mNotice .info li {
            zoom: 1;
            position: relative;
            padding: 5px 0 0 70px;
        }

        .mNotice .info li .title {
            position: absolute;
            left: 0;
            top: 5px;
            padding: 0 0 0 12px;
            font-size: 11px;
            letter-spacing: 0;
            background: url("//img.echosting.cafe24.com/suio/sflex_notice.png") -248px -296px no-repeat;
        }

        .mNotice .info li strong {
            color: #ed7f00;
        }

        /* info + bullet */
        .mNotice .info.bullet li {
            padding-left: 10px;
            background: url("//img.echosting.cafe24.com/suio/sflex_notice.png") -248px -292px no-repeat;
        }

        .mNotice .info.bullet li p {
            margin: 3px 0 0;
        }

        .mNotice .table {
            margin: 8px 0 10px;
            font-size: 11px;
            letter-spacing: 0;
            background-color: #fff;
        }

        .mNotice .table th,
        .mNotice .table td {
            padding: 6px 9px 4px;
            border: 1px solid #d9dadc;
            vertical-align: middle;
        }

        .mNotice .table th {
            font-weight: normal;
            text-align: left;
            background-color: #f5f4f4;
        }

        .mNotice .table thead th {
            text-align: center;
        }

        .mNotice .table td.center {
            text-align: center;
        }

        .mNotice .desc {
            margin: 8px 0 0;
            font-size: 11px;
            letter-spacing: 0;
        }

        .mNotice p.desc {
            padding: 0 0 0 10px;
            background: url("//img.echosting.cafe24.com/suio/sflex_notice.png") -195px -396px no-repeat;
        }

        .mNotice ul.desc li {
            padding: 0 0 2px 10px;
            background: url("//img.echosting.cafe24.com/suio/sflex_notice.png") -195px -396px no-repeat;
        }

        .mNotice .empty > li,
        .mNotice ul li.empty,
        .mNotice p.empty {
            padding-left: 0;
            font-size: 11px;
            letter-spacing: 0;
            color: #c6cbd4;
            background: none;
        }

        .mNotice p.empty {
            margin: 8px 0 0;
        }

        .mNotice .txtIcon {
            font-size: 12px;
            font-family: normal;
        }

        html:lang(ko) .mNotice .txtIcon {
            font-size: 13px;
        }

        .mNotice .more {
            margin: 10px 0 0;
            text-align: right;
        }

        .mNotice .more a {
            padding: 0 0 0 8px;
            font-size: 11px;
            letter-spacing: 0;
            color: #8b9098;
            text-decoration: none;
            background: url("//img.echosting.cafe24.com/suio/sflex_notice.png") -297px -198px no-repeat;
        }

        .mNotice .wrap .mButton {
            padding: 0;
            text-align: center;
        }

        .mNotice .wrap .mButton .btnEm,
        .mNotice .wrap .mButton .btnEm span {
            display: inline-block;
            height: 36px;
        }

        .mNotice .wrap .mButton .btnEm:hover {
            text-decoration: none;
        }

        .mNotice .wrap .mButton .btnEm:hover span {
            background-color: #f8f8f8;
        }

        .mNotice .wrap .mButton .btnEm span {
            min-width: auto;
            padding: 0 20px;
            color: #1b87d4;
            font-size: 14px;
            font-weight: normal;
            line-height: 32px;
            box-sizing: border-box;
            border: 1px solid #1b87d4;
            background-color: #fff;
        }

        .mNotice .wrap .mButton .btnEm.gFlex,
        .mNotice .wrap .mButton .btnEm.gFlex span {
            display: block;
            margin: 0;
        }

        .mNotice .footer {
            zoom: 1;
            overflow: hidden;
            padding: 5px 15px;
            background-color: #dee1e5;
        }

        .mNotice .footer .gLabel {
            float: left;
            margin: 0 5px 0 0;
            padding-right: 20px;
            font-size: 11px;
            letter-spacing: 0;
            line-height: 22px;
            color: #8b9098;
            letter-spacing: -1px;
        }

        .mNotice .footer .gLabel.eSelected {
            color: #000;
            font-weight: bold;
            letter-spacing: -2px;
        }

        .mNotice .footer .mButton {
            float: right;
            margin: auto;
            padding: 0;
            font-weight: bold;
        }

        /* width */
        .mNotice.gLarge {
            width: 440px;
            margin-left: -220px;
        }

        /* mLoading */
        .mLoading {
            display: none;
            position: absolute;
            z-index: 110;
            width: 338px;
            top: 50%;
            left: 50%;
            margin: -77px 0 0 -166px;
            padding: 0 0 27px 0;
            text-align: center;
        }

        .mLoading.typeStatic {
            position: fixed;
            top: 50%;
            left: 50%;
            margin: -77px 0 0 -166px;
        }

        .mLoading p {
            margin: 39px 0 21px;
            color: #4c5255;
        }

        /* mMovieGuide */
        .mMovieGuide {
            position: absolute;
            left: 100px;
            z-index: 110;
            width: 1020px;
            height: 613px;
            background: #fff;
        }

        .mMovieGuide .header {
            height: 41px;
            line-height: 43px;
            padding: 0 0 0 14px;
            color: #fff;
            border-top: 1px solid #787a84;
            border-bottom: 1px solid #42444d;
            background: #6f717a;
        }

        .mMovieGuide .header h1 {
            display: inline-block;
            vertical-align: top;
            font-size: 14px;
        }

        .mMovieGuide .header a {
            margin: 0 0 0 16px;
            padding: 0 5px 0 16px;
            font-weight: normal;
            color: #cfd2de;
            font-size: 11px;
            letter-spacing: 0;
            text-decoration: underline;
            border-left: 1px solid #42444d;
            background: url("//img.echosting.cafe24.com/smartAdmin/img/common/ico_link.png") no-repeat right center;
        }

        .mMovieGuide .btnClose {
            overflow: hidden;
            position: absolute;
            top: 14px;
            right: 9px;
            width: 14px;
            height: 14px;
            text-indent: 150%;
            font-size: 0;
            line-height: 0;
            white-space: nowrap;
            background: url("//img.echosting.cafe24.com/suio/sfix_btn.png") no-repeat 0 0;
        }

        .mMovieGuide .wrap {
            overflow: hidden;
            margin: 20px;
        }

        .mMovieGuide .wrap .content {
            text-align: center;
        }

        .mMovieGuide .mTab {
            overflow: hidden;
            width: 100%;
            margin: 0 0 10px;
        }

        .mMovieGuide .mTab ul:after {
            content: "";
            display: block;
            clear: both;
        }

        .mMovieGuide .mTab li {
            float: left;
            width: 25%;
            box-sizing: border-box;
            border: 1px solid #d5d5d5;
            border-left: 0;
            background: #f5f3f4;
        }

        .mMovieGuide .mTab li:first-child {
            border-left: 1px solid #d5d5d5;
        }

        .mMovieGuide .mTab li a {
            display: block;
            height: 43px;
            line-height: 43px;
            color: #6f798a;
            text-align: center;
            font-weight: bold;
            text-decoration: none;
        }

        .mMovieGuide .mTab li.selected {
            height: 45px;
            border-top: 3px solid #4d94f3;
            border-left: 1px solid #4d94f3;
            border-right: 1px solid #4d94f3;
            border-bottom: 0;
            background: #fff;
        }

        .mMovieGuide .mTab li.selected a {
            color: #4d94f3;
            height: 42px;
            line-height: 39px;
        }

        .mMovieGuide object {
            position: relative;
            z-index: 10;
        }

        .mMovieGrid {
            position: fixed;
            left: 0;
            top: 0;
            z-index: 102;
            width: 100%;
            height: 100%;
            background-color: #000;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
            opacity: 0.4;
        }

        /* mNoticeTip */
        .mNoticeTip {
            display: inline-block;
            position: relative;
            padding: 4px 28px 4px 8px;
            box-sizing: border-box;
            word-break: keep-all;
            white-space: nowrap;
            text-align: left;
            border-radius: 4px;
            background: #3971ff;
        }

        .mNoticeTip:after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 50%;
            margin: 0 0 0 -3px;
            border-top: 5px solid #3971ff;
            border-right: 4px solid transparent;
            border-left: 4px solid transparent;
        }

        .mNoticeTip.hide {
            display: none;
        }

        .mNoticeTip .notice {
            display: inline-block;
            position: relative;
            box-sizing: border-box;
            font-size: 12px;
            line-height: 18px;
            color: #fff;
            text-align: left;
            letter-spacing: -1px;
            border-radius: 4px;
            background: #3971ff;
        }

        html:lang(ko) .mNoticeTip .notice {
            font-size: 13px;
        }

        .mNoticeTip .btnClose {
            overflow: hidden;
            position: absolute;
            top: 5px;
            right: 8px;
            width: 16px;
            height: 16px;
            font-size: 1px;
            color: transparent;
            white-space: nowrap;
            text-indent: 150%;
        }

        .mNoticeTip .btnClose:before,
        .mNoticeTip .btnClose:after {
            content: "";
            position: absolute;
            top: 8px;
            left: 2px;
            width: 11px;
            height: 1px;
            background: #fff;
            transform: rotate(45deg);
        }

        .mNoticeTip .btnClose:after {
            transform: rotate(-45deg);
        }

        .mNoticeTip .txtLink {
            color: #fff;
        }

        .mNoticeTip .txtLink:hover {
            color: #fff;
        }

        .mNoticeTip.leftSide:after {
            top: 9px;
            right: auto;
            bottom: auto;
            left: -10px;
            margin: 0;
            border-bottom: 4px solid transparent;
            border-right: 6px solid #3971ff;
            border-top: 4px solid transparent;
        }

        .mNoticeTip.rightSide:after {
            top: 9px;
            right: -10px;
            bottom: auto;
            left: auto;
            border-bottom: 4px solid transparent;
            border-left: 6px solid #3971ff;
            border-top: 4px solid transparent;
        }

        /* bottom */
        .mNoticeTip.bottom:after {
            top: -5px;
            right: auto;
            bottom: auto;
            left: 50%;
            border-bottom: 5px solid #3971ff;
            border-top: none;
        }

        /* right */
        .mNoticeTip.right:after {
            left: 35px;
            right: auto;
        }

        /* left */
        .mNoticeTip.left:after {
            right: 35px;
            left: auto;
        }

        /* mInnerBox */
        .mInnerBox {
            display: flex;
            margin: 0 0 16px;
            padding: 11px 24px;
            border: 1px solid #d9dadc;
            box-sizing: border-box;
            background: #f4f9ff;
        }

        .mInnerBox .content {
            flex: 1;
        }

        .mInnerBox .icoNotice {
            display: inline-block;
            position: relative;
            width: 14px;
            height: 14px;
            margin: 3px 5px 0 0;
            border-radius: 50%;
            vertical-align: middle;
            background-color: #aeb4c6;
            background-image: none;
        }

        .mInnerBox .icoNotice:before,
        .mInnerBox .icoNotice:after {
            content: "";
            position: absolute;
            left: 6px;
            width: 2px;
            background-color: #fff;
        }

        .mInnerBox .icoNotice:before {
            top: 3px;
            height: 5px;
            border-radius: 15px;
        }

        .mInnerBox .icoNotice:after {
            bottom: 3px;
            height: 2px;
            border-radius: 50%;
        }

        .mInnerBox .btnClose {
            overflow: hidden;
            position: relative;
            width: 20px;
            height: 20px;
            font-size: 1px;
            line-height: 0;
            color: transparent;
            white-space: nowrap;
            text-indent: 150%;
        }

        .mInnerBox .btnClose:before,
        .mInnerBox .btnClose:after {
            content: "";
            position: absolute;
            top: 9px;
            left: 4px;
            width: 12px;
            height: 1px;
            border-radius: 5px;
            background: #667084;
            transform: rotate(45deg);
        }

        .mInnerBox .btnClose:after {
            transform: rotate(-45deg);
        }

        .mInnerBox .title {
            display: block;
            margin: 0 0 4px;
            font-size: 13px;
            line-height: 20px;
            color: #1b1e26;
        }

        .mInnerBox .mList {
            margin-top: 4px;
        }

        .mInnerBox .mList li {
            font-size: 13px;
            line-height: 20px;
            color: #444b59;
        }

        /* reset */
        .toggleArea > .mInnerBox {
            margin-bottom: 0;
        }

        .toggleArea > .mInnerBox + .mBoard {
            margin-top: -1px;
        }

        /* ----------------------------------------- // Overlay  ----------------------------------------- */

        /* ----------------------------------------- mSitemap ----------------------------------------- */

        .mSitemap {
            width: 788px;
            margin: -1px 0 0 0;
            border-top: 3px solid #575d68;
            background: url("//img.echosting.cafe24.com/smartAdmin/img/common/bg_sitemap.gif") repeat-y 0 0;
        }

        .mSitemap .heading {
            position: relative;
            padding: 0 0 0 210px;
            border-bottom: 1px solid #cfd3d7;
            background: #fbfbfb;
        }

        .mSitemap .heading h2 {
            position: absolute;
            left: 14px;
            top: 50%;
            height: 20px;
            margin: -11px 0 0 0;
            font-size: 20px;
            font-family: "굴림", Gulim, sans-serif;
            color: #303030;
        }

        html:lang(ja) .mSitemap .heading h2 {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mSitemap .heading h2 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mSitemap .heading .gnb {
            overflow: hidden;
        }

        .mSitemap .heading .gnb ul {
            float: left;
            margin: 0 0 0 -11px;
            padding: 9px 0 8px 0;
        }

        .mSitemap .heading .gnb li {
            float: left;
            padding: 7px 7px 7px 10px;
            line-height: 14px;
            white-space: nowrap;
            background: url("//img.echosting.cafe24.com/smartAdmin/img/common/sflex_ico_sitemap.png") no-repeat -51px 7px;
        }

        .mSitemap .heading .gnb li a {
            font-size: 11px;
            letter-spacing: 0;
            color: #5e656d;
            text-decoration: none;
        }

        .mSitemap .heading .gnb li a:hover, .mSitemap .heading ul li a.selected {
            color: #599ee1;
        }

        .mSitemap .sitemap {
            padding: 20px 0 0 0;
            border-bottom: 1px solid #cfd3d7;
        }

        .mSitemap .sitemap > li {
            display: inline-block;
            width: 176px;
            margin: 0 -4px 20px 0;
            padding: 0 11px 0 10px;
            vertical-align: top;
        }

        .mSitemap .sitemap > li img {
            margin: -1px 0 0 0;
            vertical-align: middle;
        }

        .mSitemap .sitemap > li > strong {
            display: block;
            width: 168px;
            height: 25px;
            padding: 0 0 0 8px;
            font-size: 13px;
            font-family: "굴림", Gulim, sans-serif;
            line-height: 25px;
            background: url("//img.echosting.cafe24.com/smartAdmin/img/common/bg_sitemap_2depth.gif") no-repeat 0 0;
        }

        html:lang(ja) .mSitemap .sitemap > li > strong {
            font-family: Meiryo, "メイリオ", "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", sans-serif;
        }

        html:lang(vi) .mSitemap .sitemap > li > strong {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .mSitemap .sitemap > li > strong a {
            display: block;
            color: #fff;
            text-decoration: none;
        }

        .mSitemap .sitemap > li > ul {
            margin: 13px 0 28px 0;
        }

        .mSitemap .sitemap > li > ul > li {
            margin: 10px 0 0 0;
            padding: 0 0 0 8px;
            line-height: 14px;
            background: url("//img.echosting.cafe24.com/smartAdmin/img/common/sflex_ico_sitemap.png") no-repeat 0 -95px;
        }

        .mSitemap .sitemap > li > ul > li > a {
            color: #000;
        }

        .mSitemap .sitemap > li > ul > li > ul {
            margin: 6px 0 22px 0;
        }

        .mSitemap .sitemap > li > ul > li > ul > li {
            margin: 3px 0 0 0;
        }

        .mSitemap .sitemap > li > ul > li > ul > li a {
            font-size: 11px;
            letter-spacing: 0;
            color: #989fa7;
        }

        /* ----------------------------------------- // mSitemap  ----------------------------------------- */

        /* ----------------------------------------- 에디터 Reset ----------------------------------------- */
        #_target_id_nullLayerPage legend {
            visibility: visible;
            position: static;
            left: 0;
            top: 0;
            width: auto;
            height: auto;
            line-height: 1;
        }

        #_target_id_nullLayerPage input[type=text], textarea {
            outline: none;
        }

        #_target_id_nullLayerPage table {
            table-layout: auto;
            width: auto;
            border-collapse: separate;
            border-spacing: 0;
        }

        #_target_id_nullLayerPage .nnContents {
            color: #000;
        }

        #_tablePreview table {
            width: 100%;
        }

        #_table_picColor_title table {
            table-layout: auto;
        }

        /* ----------------------------------------- // 에디터 Reset   ----------------------------------------- */

        /* ECHOSTING-414286 예외적용 */
        .nnContents input[type="checkbox"] {
            background: #FFF url(../images/form_input.gif) repeat-x scroll 0 0;
            appearance: checkbox;
            -webkit-appearance: checkbox;
        }

        .nnContents input[type="checkbox"]:checked {
            background-position: inherit;
        }

        /* ECHOSTING-417306 예외적용 */
        #layerEmoticonAlbum.mLayer .wrap {
            padding: 0 10px 16px;
        }

        /* ECHOSTING-417659 예외적용 */
        #popup #QA_contact_manage2.section .mBoard {
            overflow: auto;
            height: 290px;
        }

        #popup #QA_contact_manage2.section .mBoard table th,
        #popup #QA_contact_manage2.section .mBoard table td {
            padding: 6px 8px;
            height: auto;
        }

        /* ECHOSTING-419755 예외적용 */
        .eEditOptionList .w140 {
            width: 142px
        }

        .eEditOptionList .w140 .fSelect {
            padding: 0 20px 0 8px;
        }

        #eItemListContainer .eItemRow .w140 {
            width: 142px
        }

        #eItemListContainer .eItemRow .w140 .fSelect {
            padding: 0 20px 0 8px;
        }

        #eItemListContainer .eItemRow .mBoard.gSmall th {
            width: 90px;
        }

        /* 네이버 브라우저 가로 스크롤 대응 */
        .whaleBrowser .mBoard.gScroll {
            border-bottom: 1px solid #d9dadc;
        }

        .whaleBrowser .mBoard.gScroll::-webkit-scrollbar {
            height: 5px;
        }

        .whaleBrowser .mBoard.gScroll::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: #c3c4c6 !important;
        }

        .whaleBrowser .mBoard.gScroll::-webkit-scrollbar-thumb:hover,
        .whaleBrowser .mBoard.gScroll::-webkit-scrollbar-thumb:active {
            background: #aeaeae !important;
        }

        .whaleBrowser .mBoard.gScroll::-webkit-scrollbar-track {
            border-radius: 10px;
            background: #f9f9f9 !important;
        }

        @media print {
            .section {
                margin-bottom: 10px;
            }

            #popup #wrap {
                padding: 0;
                font-size: 12px !important;
            }

            #popup #footer, .mCtrl, .mButton, .mTooltip {
                display: none;
            }

            .headingArea .mTitle {
                margin-top: 0;
            }

            .headingArea h1 {
                line-height: 28px;
                background-position: -494px 7px;
            }

            .mTitle {
                margin-bottom: 5px;
            }

            .mBoard th, .mBoard td {
                height: auto !important;
            }

            .mBoard table th,
            .mBoard table td {
                padding: 2px !important;
                border: 1px solid #777 !important;
                font-size: 12px !important;
            }

            .mBoard th {
                color: #1c1c1c !important;
            }

            .mBoard.gScroll {
                overflow: visible;
            }

            .mBoard .gGoods p,
            .mBoard .gGoods ul {
                font-size: 12px !important;
                line-height: 12px !important;
            }

            .mBoard .gGoods .etc,
            .mBoard .gGoods .etc a {
                color: #1c1c1c;
            }

            .mBoard .gGoods .set,
            .mBoard .gGoods .set a {
                color: #1c1c1c;
            }

            .btnNormal span, .btnCtrl span, .btnDate span, .btnGeneral span, .btnStrong span, .btnSubmit span, .btnEm span, .btnSearch span {
                border: 1px solid #777;
            }
        }

        @media print and (-webkit-min-device-pixel-ratio: 0) {
            html, body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td, span, strong {
                font-family: "맑은 고딕", "Malgun Gothic", sans-serif !important;
            }
        }
    </style>
<body id="popup" class="">
<div id="wrap" class="wrapHidden">

    <div id="wrap">
        <div class="headingArea">
            <div class="mTitle">
                <h1>메시지 변수 관리</h1>
            </div>
            <p class="mDesc">메세지에 사용되는 변수를 확인할 수 있으며 메시지에 표시되는 글자수를 설정할 수 있어요.</p>
        </div>

        <form id="configForm" name="config_form" method="post" action="/exec/admin/shop1/sms/Manage">
            <input type="hidden" name="mode" value="Popupvar">
            <div id="QA_message_variable1" class="section">
                <div class="mBoard" style="padding: 0 0 30px">
                    <table border="1" summary="">
                        <caption>메시지 변수 관리</caption>
                        <colgroup>
                            <col style="width:150px;">
                            <col style="width:180px;">
                            <col style="width:auto;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">변수명</th>
                            <th scope="col">변수 설명</th>
                            <th scope="col">사용가능 발송상황</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>[NAME]</td>
                            <td>회원 이름
                                <p class="mList">(예) 홍길동</p>
                            </td>
                            <td>각 발송상황에 모두 사용가능</td>
                        </tr>
                        <tr>
                            <td>[USERID]</td>
                            <td>회원 아이디
                                <p class="mList">(예) test1234</p>
                            </td>
                            <td>각 발송상황에 모두 사용가능</td>
                        </tr>
                        <tr>
                            <td>[USER_EMAIL]</td>
                            <td>회원 이메일
                                <p class="mList">(예) test1234@sample.com</p>
                            </td>
                            <td>각 발송상황에 모두 사용가능</td>
                        </tr>
                        <tr>
                            <td>[PRODUCT]</td>
                            <td>상품명
                                <p class="mList">(예) 노란 원피스</p>
                            </td>
                            <td>주문 관련 메시지, 주문 CS 관련 메시지, 정기배송 관련 메시지, 재입고 완료 안내, 추가 입금 요청</td>
                        </tr>
                        <tr>
                            <td>[BOARD_NAME]</td>
                            <td>게시판 이름
                                <p class="mList">(예) 자유게시판</p>
                            </td>
                            <td>게시판 신규게시글 통보, 게시판 게시물 답변 통보, 게시판 댓글 등록</td>
                        </tr>
                        <tr>
                            <td>[SUBJECT]</td>
                            <td>글 제목
                                <p class="mList">(예) 상품문의드립니다</p>
                            </td>
                            <td>게시판 신규게시글 통보, 게시판 게시물 답변 통보, 게시판 댓글 등록</td>
                        </tr>
                        <tr>
                            <td>[DATE]</td>
                            <td>날짜
                                <p class="mList">(예) 2090-05-17</p>
                            </td>
                            <td>주문 완료 안내, 주문 결제 완료, 무통장 입금 완료, 발송 조치, 배송완료, 취소/반품/교환 접수 및 주문상품 추가, 정기배송 결제 안내, 정기배송 재개,
                                정기배송 해지, 정기배송 예정일 변경, 정기배송 주기변경
                            </td>
                        </tr>
                        <tr>
                            <td>[ORDERID]</td>
                            <td>주문번호
                                <p class="mList">(예) 20900517-0000001</p>
                            </td>
                            <td>주문 완료 안내, 특별관리회원 주문 안내, 주문 결제 완료, 무통장 입금 완료, 배송 대기, 송장 번호 포함 발송조치 (완전배송), 송장 번호 포함 발송조치
                                (부분배송), 배송완료, 주문 적립금 지급, 취소/반품/교환 접수 및 주문상품 추가, 취소/반품/교환 신청, 취소/반품/교환 접수 거부, 취소/반품/교환
                                철회, 취소/반품/교환 완료, 수거 완료, 입금 만료 예정, 입금 전 취소, 구매 확정, 구매 확정 요청, 정기배송 결제 실패, 배송 준비중 안내, 추가 입금
                                요청
                            </td>
                        </tr>
                        <tr>
                            <td>[PRICE]</td>
                            <td>주문금액
                                <p class="mList">(예) 10,000</p>
                            </td>
                            <td>주문 완료 안내, 주문 결제 완료, 입금 안내, 입금 요청, 무통장 입금 완료, 예약결제 상품 결제 안내, 입금 만료 예정, 정기배송 결제 안내, 비회원 주문
                                조회 안내, 추가 입금 요청
                            </td>
                        </tr>
                        <tr>
                            <td>[REFUND]</td>
                            <td>환불금액
                                <p class="mList">(예) 10,000</p>
                            </td>
                            <td>카드결제 부분취소 안내, 카드결제 전체취소 안내</td>
                        </tr>
                        <tr>
                            <td>[BANK]</td>
                            <td>입금은행
                                <p class="mList">(예) KEB하나은행</p>
                            </td>
                            <td>입금 안내, 입금 요청, 입금 만료 예정, 추가 입금 요청</td>
                        </tr>
                        <tr>
                            <td>[ACCOUNT]</td>
                            <td>입금 계좌번호
                                <p class="mList">(예) 123456789</p>
                            </td>
                            <td>입금 안내, 입금 요청, 입금 만료 예정, 추가 입금 요청</td>
                        </tr>
                        <tr>
                            <td>
                                [DEPOSITOR]
                            </td>
                            <td>예금주
                                <p class="mList">(예) 홍길동</p>
                            </td>
                            <td>입금 안내, 입금 요청, 입금 만료 예정, 추가 입금 요청</td>
                        </tr>
                        <tr>
                            <td>[AUTOCANCELDATE]
                            </td>
                            <td>입금만료일
                                <p class="mList">(예) 입금만료12/31까지</p>
                            </td>
                            <td>입금 안내, 입금 요청, 입금 만료 예정</td>
                        </tr>
                        <tr>
                            <td>[쇼핑몰이름]</td>
                            <td>쇼핑몰명
                                <p class="mList">(예) 아름다운쇼핑몰</p>
                            </td>
                            <td>각 발송상황에 모두 사용가능</td>
                        </tr>
                        <tr>
                            <td>[DELICOM]</td>
                            <td>택배사 이름
                                <p class="mList">(예) CJ택배</p>
                            </td>
                            <td>송장 번호 포함 발송조치 (완전배송), 송장 번호 포함 발송조치 (부분배송)</td>
                        </tr>
                        <tr>
                            <td>[DELINUM]</td>
                            <td>송장번호
                                <p class="mList">(예) 123456</p>
                            </td>
                            <td>송장 번호 포함 발송조치 (완전배송), 송장 번호 포함 발송조치 (부분배송)</td>
                        </tr>
                        <tr>
                            <td>[PID]</td>
                            <td>상품코드(자동)
                                <p class="mList">(예) 1234</p>
                            </td>
                            <td>재입고 완료 안내</td>
                        </tr>
                        <tr>
                            <td>[COUPON_NAME]</td>
                            <td>쿠폰 이름
                                <p class="mList">(예) 10주년 기념 쿠폰</p>
                            </td>
                            <td>쿠폰 발급 안내, 다운로드 쿠폰 만료 예정, 쿠폰 만료 예정</td>
                        </tr>
                        <tr>
                            <td>[PW]</td>
                            <td>임시 비밀번호
                                <p class="mList">(예) A1234567</p>
                            </td>
                            <td>비밀번호 안내</td>
                        </tr>
                        <tr>
                            <td>[VERIFY]</td>
                            <td>본인확인 인증번호
                                <p class="mList">(예) 123456</p>
                            </td>
                            <td>본인확인 인증번호 발송</td>
                        </tr>
                        <tr>
                            <td>[OLD_GRADE]</td>
                            <td>변경 전 회원등급
                                <p class="mList">(예) 일반회원</p>
                            </td>
                            <td>회원등급 변경(상승), 회원등급 변경(하락), 회원등급 변경(수동)</td>
                        </tr>
                        <tr>
                            <td>[CURRENT_GRADE]</td>
                            <td>변경 후 회원등급
                                <p class="mList">(예) VIP회원</p>
                            </td>
                            <td>회원등급 변경(상승), 회원등급 변경(하락), 회원등급 변경(수동)</td>
                        </tr>
                        <tr>
                            <td>[GRADE_CHANGE]</td>
                            <td>회원등급 변경일자
                                <p class="mList">(예) 2090-05-17</p>
                            </td>
                            <td>회원등급 변경(상승), 회원등급 변경(하락), 회원등급 변경(수동)</td>
                        </tr>


                        <tr>
                            <td>[NOW_PNT]</td>
                            <td>현재 적립금
                                <p class="mList">(예) 10,000</p>
                            </td>
                            <td>적립금 소멸 안내, 주문 적립금 지급</td>
                        </tr>
                        <tr>
                            <td>[DEL_PNT]</td>
                            <td>소멸예정 적립금
                                <p class="mList">(예) 10,000</p>
                            </td>
                            <td>적립금 소멸 안내</td>
                        </tr>
                        <tr>
                            <td>[REJECT_TEL]</td>
                            <td>무료수신거부 전화번호
                                <p class="mList">(예) 08012341234</p>
                            </td>
                            <td>기념일 쿠폰 발급 안내, 쿠폰발급 안내</td>
                        </tr>

                        <tr>
                            <td>[ACCOUNT_HOLDER]</td>
                            <td>입금자명
                                <p class="mList">(예) 홍길동</p>
                            </td>
                            <td>입금 안내, 입금 요청, 입금 만료 예정, 추가 입금 요청</td>
                        </tr>
                        <tr>
                            <td>[TO_PNT]</td>
                            <td>소멸 후 남는 적립금
                                <p class="mList">(예) 10,000</p>
                            </td>
                            <td>적립금 소멸 안내</td>
                        </tr>
                        <tr>
                            <td>[ORDERCS_TYPE]</td>
                            <td>주문 CS 유형
                                <p class="mList">(예) 반품</p>
                            </td>
                            <td>취소/반품/교환 접수 및 주문상품 추가, 취소/반품/교환 신청, 취소/반품/교환 접수 거부, 취소/반품/교환 철회, 취소/반품/교환 완료, 수거완료, 추가
                                입금 요청
                            </td>
                        </tr>
                        <tr>
                            <td>[ADD_PNT]</td>
                            <td>지급 적립금
                                <p class="mList">(예) 1,000</p>
                            </td>
                            <td>주문 적립금 지급</td>
                        </tr>
                        <tr>
                            <td>[RDORDERID]</td>
                            <td>정기배송 신청 번호
                                <p class="mList">(예) S-20230405-0000010</p>
                            </td>
                            <td>정기배송 결제 실패, 정기배송 일시정지, 정기배송 재개, 정기배송 해지, 정기배송 예정일 변경, 정기배송 주기 변경, 정기배송 결제실패 사유 안내</td>
                        </tr>
                        <tr>
                            <td>[DORMANT_DATE]</td>
                            <td>휴면회원 전환일
                                <p class="mList">(예) 2090-05-07</p>
                            </td>
                            <td>휴면회원 전환 사전 안내</td>
                        </tr>
                        <tr>
                            <td>[PURCHASECONFIRM_URL]</td>
                            <td>구매 확정 전용 페이지
                                <p class="mList">(예) https://domain.cafe24.com/order/confirm.html?uk=72AE25495A79</p>
                            </td>
                            <td>구매 확정 요청</td>
                        </tr>
                        <tr>
                            <td>[ORDER_URL]</td>
                            <td>비회원 주문조회 페이지
                                <p class="mList">(예) https://domain.cafe24.com/order/verify.html?uk=72AE25495A79</p>
                            </td>
                            <td>비회원 주문조회 안내</td>
                        </tr>
                        <tr>
                            <td>[FAILMSG]</td>
                            <td>실패 사유 별 안내문구
                                <p class="mList">(예) 거래정지</p>
                            </td>
                            <td>정기배송 결제실패 사유 안내</td>
                        </tr>
                        <tr>
                            <td>[GUIDMSG]</td>
                            <td>실패 사유 별 구매자 가이드 안내문구
                                <p class="mList">(예) 결제카드 변경 또는 결제카드사에 문의해주세요.</p>
                            </td>
                            <td>정기배송 결제실패 사유 안내</td>
                        </tr>
                        <tr>
                            <td>[DAYSAGO]</td>
                            <td>만료 전 안내일 표시
                                <p class="mList">(예) 3일 뒤</p>
                            </td>
                            <td>쿠폰 만료 예정, 다운로드 쿠폰 만료 예정, 적립금 소멸 안내</td>
                        </tr>
                        <!--
    <tr>
        <td>[ORDER_PW]</td>
        <td>비회원 주문조회용 비밀번호
            <p class="mList">password@01</p>
        </td>
        <td>비회원 주문조회 비밀번호 안내</td>
    </tr>
    -->
                        <tr>
                            <td>[MALL_URL]</td>
                            <td>상점대표 도메인
                                <p class="mList">(예)&nbsp;https://testmall24.com</p>
                            </td>
                            <td>각 발송상황에 모두 사용가능</td>
                        </tr>
                        <tr>
                            <td>[BIZ_TEL]</td>
                            <td>대표 전화번호
                                <p class="mList">(예)&nbsp;070-1234-5678</p>
                            </td>
                            <td>각 발송상황에 모두 사용가능</td>
                        </tr>
                        <tr>
                            <td>[MALL_TEL]</td>
                            <td>상담/주문 전화번호
                                <p class="mList">(예) 1588-0000</p>
                            </td>
                            <td>각 발송상황에 모두 사용가능</td>
                        </tr>
                        <tr>
                            <td>[ID_TYPE]</td>
                            <td>계정 형태<p class="mList">(예) 일반 계정 로그인</p></td>
                            <td>휴면 일반회원 전환 사전안내, 휴면 일반회원 전환 사후 안내</td>
                        </tr>
                        <tr>
                            <td>[REACTIVATE_DATE]</td>
                            <td>일반 계정 전환 예정일<p class="mList">(예) 2024.01.01</p></td>
                            <td>휴면 일반회원 전환 사전안내, 휴면 일반회원 전환 사후 안내</td>
                        </tr>
                        <tr>
                            <td>[IE_DATE]</td>
                            <td>휴면회원 대상자 추출일<p class="mList">(예) 2024.01.01</p></td>
                            <td>휴면 일반회원 전환 사전안내, 휴면 일반회원 전환 사후 안내</td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

</div>