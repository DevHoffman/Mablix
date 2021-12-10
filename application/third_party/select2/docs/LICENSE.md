/**
 * @license Highcharts JS v6.0.4 (2017-12-15)
 *
 * 3D features for Highcharts JS
 *
 * @license: www.highcharts.com/license
 */
'use strict';
(function(factory) {
    if (typeof module === 'object' && module.exports) {
        module.exports = factory;
    } else {
        factory(Highcharts);
    }
}(function(Highcharts) {
    (function(H) {
        /**
         * (c) 2010-2017 Torstein Honsi
         *
         * License: www.highcharts.com/license
         */
        /**
         *	Mathematical Functionility
         */
        var deg2rad = H.deg2rad,
            pick = H.pick;
        /**
         * Apply 3-D rotation
         * Euler Angles (XYZ): cosA = cos(Alfa|Roll), cosB = cos(Beta|Pitch), cosG = cos(Gamma|Yaw) 
         * 
         * Composite rotation:
         * |          cosB * cosG             |           cosB * sinG            |    -sinB    |
         * | sinA * sinB * cosG - cosA * sinG | sinA * sinB * sinG + cosA * cosG | sinA * cosB |
         * | cosA * sinB * cosG + sinA * sinG | cosA * sinB * sinG - sinA * cosG | cosA * cosB |
         * 
         * Now, Gamma/Yaw is not used (angle=0), so we assume cosG = 1 and sinG = 0, so we get:
         * |     cosB    |   0    |   - sinB    |
         * | sinA * sinB |  cosA  | sinA * cosB |
         * | cosA * sinB | - sinA | cosA * cosB |
         * 
         * But in browsers, y is reversed, so we get sinA => -sinA. The general result is:
         * |      cosB     |   0    |    - sinB     |     | x |     | px |
         * | - sinA * sinB |  cosA  | - sinA * cosB |  x  | y |  =  | py | 
         * |  cosA * sinB  |  sinA  |  cosA * cosB  |     | z |     | pz |
         */
        function rotate3D(x, y, z, angles) {
            return {
                x: angles.cosB * x - angles.sinB * z,
                y: -angles.sinA * angles.sinB * x + angles.cosA * y - angles.cosB * angles.sinA * z,
                z: angles.cosA * angles.sinB * x + angles.sinA * y + angles.cosA * angles.cosB * z
            };
        }

        function perspective3D(coordinate, origin, distance) {
            var projection = ((distance > 0) && (distance < Number.POSITIVE_INFINITY)) ? distance / (coordinate.z + origin.z + distance) : 1;
            return {
                x: coordinate.x * projection,
                y: coordinate.y * projection
            };
        }

        /**
         * Transforms a given array of points according to the angles in chart.options.
         * Parameters:
         *		- points: the array of points
         *		- chart: the chart
         *		- insidePlotArea: wether to verifiy the points are inside the plotArea
         * Returns:
         *		- an array of transformed points
         */
        H.perspective = function(points, chart, insidePlotArea) {
            var options3d = chart.options.chart.options3d,
                inverted = insidePlotArea ? chart.inverted : false,
                origin = {
                    x: chart.plotWidth / 2,
                    y: chart.plotHeight / 2,
                    z: options3d.depth / 2,
                    vd: pick(options3d.depth, 1) * pick(options3d.viewDistance, 0)
                },
                scale = chart.scale3d || 1,
                beta = deg2rad * options3d.beta * (inverted ? -1 : 1),
                alpha = deg2rad * options3d.alpha * (inverted ? -1 : 1),
                angles = {
                    cosA: Math.cos(alpha),
                    cosB: Math.cos(-beta),
                    sinA: Math.sin(alpha),
                    sinB: Math.sin(-beta)
                };

            if (!insidePlotArea) {
                origin.x += chart.plotLeft;
                origin.y += chart.plotTop;
            }

            // Transform each point
            return H.map(points, function(point) {
                var rotated = rotate3D(
                        (inverted ? point.y : point.x) - origin.x,
                        (inverted ? point.x : point.y) - origin.y,
                        (point.z || 0) - origin.z,
                        angles
                    ),
                    coordinate = perspective3D(rotated, origin, origin.vd); // Apply perspective

                // Apply translation
                coordinate.x = coordinate.x * scale + origin.x;
                coordinate.y = coordinate.y * scale + origin.y;
                coordinate.z = rotated.z * scale + origin.z;

                return {
                    x: (inverted ? coordinate.y : coordinate.x),
                    y: (inverted ? coordinate.x : coordinate.y),
                    z: coordinate.z
                };
            });
        };

        /**
         * Calculate a distance from camera to points - made for calculating zIndex of scatter points.
         * Parameters:
         *		- coordinates: The coordinates of the specific point
         *		- chart: the chart
         * Returns:
         *		- a distance from camera to point
         */
        H.pointCameraDistance = function(coordinates, chart) {
            var options3d = chart.options.chart.options3d,
                cameraPosition = {
                    x: chart.plotWidth / 2,
                    y: chart.plotHeight / 2,
                    z: pick(options3d.depth, 1) * pick(options3d.viewDistance, 0) + options3d.depth
                },
                distance = Math.sqrt(Math.pow(cameraPosition.x - coordinates.plotX, 2) + Math.pow(cameraPosition.y - coordinates.plotY, 2) + Math.pow(cameraPosition.z - coordinates.plotZ, 2));
            return distance;
        };

        /**
         * Calculate area of a 2D polygon using Shoelace algorithm
         * http://en.wikipedia.org/wiki/Shoelace_formula
         */
        H.shapeArea = function(vertexes) {
            var area = 0,
                i,
                j;
            for (i = 0; i < vertexes.length; i++) {
                j = (i + 1) % vertexes.length;
                area += vertexes[i].x * vertexes[j].y - vertexes[j].x * vertexes[i].y;
            }
            return area / 2;
        };

        /**
         * Calculate area of a 3D polygon after perspective projection
         */
        H.shapeArea3d = function(vertexes, chart, insidePlotArea) {
            return H.shapeArea(H.perspective(vertexes, chart, insidePlotArea));
        };


    }(Highcharts));
    (function(H) {
        /**
         * (c) 2010-2017 Torstein Honsi
         *
         * License: www.highcharts.com/license
         */
        var cos = Math.cos,
            PI = Math.PI,
            sin = Math.sin;


        var animObject = H.animObject,
            charts = H.charts,
            color = H.color,
            defined = H.defined,
            deg2rad = H.deg2rad,
            each = H.each,
            extend = H.extend,
            inArray = H.inArray,
            map = H.map,
            merge = H.merge,
            perspective = H.perspective,
            pick = H.pick,
            SVGElement = H.SVGElement,
            SVGRenderer = H.SVGRenderer,
            wrap = H.wrap;
        /*
        	EXTENSION TO THE SVG-RENDERER TO ENABLE 3D SHAPES
        */
        // HELPER METHODS //

        var dFactor = (4 * (Math.sqrt(2) - 1) / 3) / (PI / 2);

        /** Method to construct a curved path
         * Can 'wrap' around more then 180 degrees
         */
        function curveTo(cx, cy, rx, ry, start, end, dx, dy) {
            var result = [],
                arcAngle = end - start;
            if ((end > start) && (end - start > Math.PI / 2 + 0.0001)) {
                result = result.concat(curveTo(cx, cy, rx, ry, start, start + (Math.PI / 2), dx, dy));
                result = result.concat(curveTo(cx, cy, rx, ry, start + (Math.PI / 2), end, dx, dy));
                return result;
            }
            if ((end < start) && (start - end > Math.PI / 2 + 0.0001)) {
                result = result.concat(curveTo(cx, cy, rx, ry, start, start - (Math.PI / 2), dx, dy));
                result = result.concat(curveTo(cx, cy, rx, ry, start - (Math.PI / 2), end, dx, dy));
                return result;
            }
            return [
                'C',
                cx + (rx * Math.cos(start)) - ((rx * dFactor * arcAngle) * Math.sin(start)) + dx,
                cy + (ry * Math.sin(start)) + ((ry * dFactor * arcAngle) * Math.cos(start)) + dy,
                cx + (rx * Math.cos(end)) + ((rx * dFactor * arcAngle) * Math.sin(end)) + dx,
                cy + (ry * Math.sin(end)) - ((ry * dFactor * arcAngle) * Math.cos(end)) + dy,

                cx + (rx * Math.cos(end)) + dx,
                cy + (ry * Math.sin(end)) + dy
            ];
        }



        SVGRenderer.prototype.toLinePath = function(points, closed) {
            var result = [];

            // Put "L x y" for each point
            each(points, function(point) {
                result.push('L', point.x, point.y);
            });

            if (points.length) {
                // Set the first element to M
                result[0] = 'M';

                // If it is a closed line, add Z
                if (closed) {
                    result.push('Z');
                }
            }

            return result;
        };

        SVGRenderer.prototype.toLineSegments = function(points) {
            var result = [];

            var m = true;
            each(points, function(point) {
                result.push(m ? 'M' : 'L', point.x, point.y);
                m = !m;
            });

            return result;
        };

        /**
         * A 3-D Face is defined by it's 3D vertexes, and is only
         * visible if it's vertexes are counter-clockwise (Back-face culling).
         * It is used as a polyhedron Element
         */
        SVGRenderer.prototype.face3d = function(args) {
            var renderer = this,
                ret = this.createElement('path');
            ret.vertexes = [];
            ret.insidePlotArea = false;
            ret.enabled = true;

            wrap(ret, 'attr', function(proceed, hash) {
                if (typeof hash === 'object' &&
                    (defined(hash.enabled) || defined(hash.vertexes) || defined(hash.insidePlotArea))) {
                    this.enabled = pick(hash.enabled, this.enabled);
                    this.vertexes = pick(hash.vertexes, this.vertexes);
                    this.insidePlotArea = pick(hash.insidePlotArea, this.insidePlotArea);
                    delete hash.enabled;
                    delete hash.vertexes;
                    delete hash.insidePlotArea;

                    var chart = charts[renderer.chartIndex],
                        vertexes2d = perspective(this.vertexes, chart, this.insidePlotArea),
                        path = renderer.toLinePath(vertexes2d, true),
                        area = H.shapeArea(vertexes2d),
                        visibility = (this.enabled && area > 0) ? 'visible' : 'hidden';

                    hash.d = path;
                    hash.visibility = visibility;
                }
                return proceed.apply(this, [].slice.call(arguments, 1));
            });

            wrap(ret, 'animate', function(proceed, params) {
                if (typeof params === 'object' &&
                    (defined(params.enabled) || defined(params.vertexes) || defined(params.insidePlotArea))) {
                    this.enabled = pick(params.enabled, this.enabled);
                    this.vertexes = pick(params.vertexes, this.vertexes);
                    this.insidePlotArea = pick(params.insidePlotArea, this.insidePlotArea);
                    delete params.enabled;
                    delete params.vertexes;
                    delete params.insidePlotArea;

                    var chart = charts[renderer.chartIndex],
                        vertexes2d = perspective(this.vertexes, chart, this.insidePlotArea),
                        path = renderer.toLinePath(vertexes2d, true),
                        area = H.shapeArea(vertexes2d),
                        visibility = (this.enabled && area > 0) ? 'visible' : 'hidden';

                    params.d = path;
                    this.attr('visibility', visibility);
                }

                return proceed.apply(this, [].slice.call(arguments, 1));
            });

            return ret.attr(args);
        };

        /**
         * A Polyhedron is a handy way of defining a group of 3-D faces.
         * It's only attribute is `faces`, an array of attributes of each one of it's Face3D instances.
         */
        SVGRenderer.prototype.polyhedron = function(args) {
            var renderer = this,
                result = this.g(),
                destroy = result.destroy;


            result.attr({
                'stroke-linejoin': 'round'
            });


            result.faces = [];


            // destroy all children
            result.destroy = function() {
                for (var i = 0; i < result.faces.length; i++) {
                    result.faces[i].destroy();
                }
                return destroy.call(this);
            };

            wrap(result, 'attr', function(proceed, hash, val, complete, continueAnimation) {
                if (typeof hash === 'object' && defined(hash.faces)) {
                    while (result.faces.length > hash.faces.length) {
                        result.faces.pop().destroy();
                    }
                    while (result.faces.length < hash.faces.length) {
                        result.faces.push(renderer.face3d().add(result));
                    }
                    for (var i = 0; i < hash.faces.length; i++) {
                        result.faces[i].attr(hash.faces[i], null, complete, continueAnimation);
                    }
                    delete hash.faces;
                }
                return proceed.apply(this, [].slice.call(arguments, 1));
            });

            wrap(result, 'animate', function(proceed, params, duration, complete) {
                if (params && params.faces) {
                    while (result.faces.length > params.faces.length) {
                        result.faces.pop().destroy();
                    }
                    while (result.faces.length < params.faces.length) {
                        result.faces.push(renderer.face3d().add(result));
                    }
                    for (var i = 0; i < params.faces.length; i++) {
                        result.faces[i].animate(params.faces[i], duration, complete);
                    }
                    delete params.faces;
                }
                return proceed.apply(this, [].slice.call(arguments, 1));
            });

            return result.attr(args);
        };

        // CUBOIDS //
        SVGRenderer.prototype.cuboid = function(shapeArgs) {

            var result = this.g(),
                destroy = result.destroy,
                paths = this.cuboidPath(shapeArgs);


            result.attr({
                'stroke-linejoin': 'round'
            });


            // create the 3 sides
            result.front = this.path(paths[0]).attr({
                'class': 'highcharts-3d-front'
            }).add(result); // Front, top and side are never overlapping in our case so it is redundant to set zIndex of every element.
            result.top = this.path(paths[1]).attr({
                'class': 'highcharts-3d-top'
            }).add(result);
            result.side = this.path(paths[2]).attr({
                'class': 'highcharts-3d-side'
            }).add(result);

            // apply the fill everywhere, the top a bit brighter, the side a bit darker
            result.fillSetter = function(fill) {
                this.front.attr({
                    fill: fill
                });
                this.top.attr({
                    fill: color(fill).brighten(0.1).get()
                });
                this.side.attr({
                    fill: color(fill).brighten(-0.1).get()
                });
                this.color = fill;

                // for animation getter (#6776)
                result.fill = fill;

                return this;
            };

            // apply opacaity everywhere
            result.opacitySetter = function(opacity) {
                this.front.attr({
                    opacity: opacity
                });
                this.top.attr({
                    opacity: opacity
                });
                this.side.attr({
                    opacity: opacity
                });
                return this;
            };

            result.attr = function(args, val, complete, continueAnimation) {

                // Resolve setting attributes by string name
                if (typeof args === 'string' && typeof val !== 'undefined') {
                    var key = args;
                    args = {};
                    args[key] = val;
                }

                if (args.shapeArgs || defined(args.x)) {
                    var shapeArgs = args.shapeArgs || args;
                    var paths = this.renderer.cuboidPath(shapeArgs);
                    this.front.attr({
                        d: paths[0]
                    });
                    this.top.attr({
                        d: paths[1]
                    });
                    this.side.attr({
                        d: paths[2]
                    });
                } else {
                    // getter returns value
                    return SVGElement.prototype.attr.call(
                        this, args, undefined, complete, continueAnimation
                    );
                }

                return this;
            };

            result.animate = function(args, duration, complete) {
                if (defined(args.x) && defined(args.y)) {
                    var paths = this.renderer.cuboidPath(args);
                    this.front.animate({
                        d: paths[0]
                    }, duration, complete);
                    this.top.animate({
                        d: paths[1]
                    }, duration, complete);
                    this.side.animate({
                        d: paths[2]
             