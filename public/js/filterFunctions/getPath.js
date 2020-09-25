export default class GetPath{
    static splitUrl(url, delimiter){
        let array = url.split(delimiter);
        array.shift();
        array.shift();
        return array;
    }
}