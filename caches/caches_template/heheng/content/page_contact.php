<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","head"); ?>
<?php include template("content","position"); ?>
    <div class="public w1200 fix">
        <div class="public_nav le">
            <ul>
                <?php include template("content","nav"); ?>
            </ul>
        </div>
        <div class="contact public_right rt">
            <em><div id="dituContent" style="width: 890px;height: 321px;"></div></em>
            <ul>
                <li class="fix">
                    <img src="/statics/heheng/images/contact1.png">
                    <p>电话：<?php echo $config['tel'];?></p>
                </li>
                <li class="fix">
                    <img src="/statics/heheng/images/contact2.png">
                    <p>邮箱：<?php echo $config['email'];?></p>
                </li>
                <li class="fix">
                    <img src="/statics/heheng/images/contact3.png">
                    <p>QQ：<?php echo $config['QQ'];?></p>
                </li>
                 <li class="fix">
                    <img src="/statics/heheng/images/contact4.png">
                    <p>传真：<?php echo $config['fax'];?></p>
                </li>
                <li class="fix">
                    <img src="/statics/heheng/images/contact5.png">
                    <p>地址：<?php echo $config['addr'];?></p>
                </li>
            </ul>
        </div>
    </div>
<?php include template("content","foot"); ?>
<?php $jw = explode(',',$config['jw']);  $lat =$jw[0];$lng=$jw[1];?>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=56srZYI3vAB9XzW2B0u544hHhsdWdE7X"></script>

<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMapOverlay();//向地图添加覆盖物
    }
    function createMap(){
        map = new BMap.Map("dituContent");
        map.centerAndZoom(new BMap.Point(<?php echo $lng;?>,<?php echo $lat;?>),18);
    }
    function setMapEvent(){
        map.enableScrollWheelZoom();
        map.enableKeyboard();
        map.enableDragging();
        map.enableDoubleClickZoom()
    }
    function addClickHandler(target,window){
        target.addEventListener("click",function(){
            target.openInfoWindow(window);
        });
    }
    function addMapOverlay(){
        var markers = [

            {content:"合恒科技",title:"合恒科技",imageOffset: {width:-46,height:-21},position:{lat:<?php echo $lat;?>,lng:<?php echo $lng;?>}}
        ];
        for(var index = 0; index < markers.length; index++ ){
            var point = new BMap.Point(markers[index].position.lng,markers[index].position.lat);
            var marker = new BMap.Marker(point,{icon:new BMap.Icon("http://api.map.baidu.com/lbsapi/createmap/images/icon.png",new BMap.Size(20,25),{
                    imageOffset: new BMap.Size(markers[index].imageOffset.width,markers[index].imageOffset.height)
                })});
            var label = new BMap.Label(markers[index].title,{offset: new BMap.Size(25,5)});
            var opts = {
                width: 200,
                title: markers[index].title,
                enableMessage: false
            };
            var infoWindow = new BMap.InfoWindow(markers[index].content,opts);
            marker.setLabel(label);
            addClickHandler(marker,infoWindow);
            map.addOverlay(marker);
        };
    }
    //向地图添加控件
    function addMapControl(){
        var scaleControl = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
        scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
        map.addControl(scaleControl);
        var navControl = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
        map.addControl(navControl);
        var overviewControl = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:true});
        map.addControl(overviewControl);
    }
    var map;
    initMap();
</script>