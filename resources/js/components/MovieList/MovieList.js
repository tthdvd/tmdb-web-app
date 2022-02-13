import React, {useEffect, useState} from 'react'
import {useQuery} from "react-query";
import {apiEndPoints} from '../routes'
import MovieCard from "./MovieCard";
import InfiniteScroll from "react-infinite-scroll-component";
import {ImageList, ImageListItem, ListSubheader} from "@mui/material";
import Loading from "./Loading";

const MovieList = () => {
    const [page, setPage] = useState(1)
    const [movies, setMovies] = useState([])
    const [hasMore, setHasMore] = useState(true)

    const fetchMovies = () => {
        return axios.get(
            apiEndPoints.listMovies,
            {
                params: {
                    page
                }
            }
        )
    }

    const {
        isLoading,
        data,
    } = useQuery(['movies', page], fetchMovies, {keepPreviousData: true})

    useEffect(() => {
        if (data?.data?.data) {
            setMovies(oldMovies => [...oldMovies, ...data.data.data])
            setHasMore(page !== data.data.last_page)
        }
    }, [data])

    const renderMoviesCard = () => {
        return movies.map((movie) => {
            return <React.Fragment>
                <MovieCard
                    key={movie.id}
                    title={movie.title}
                    tmdb_url={movie.tmdb_url}
                    poster_url={movie.poster_url}
                />
            </React.Fragment>
        })
    }

    const loadMore = () => {
        setPage(old => old + 1)
    }

    const renderLoading = () => {
        return <Loading/>
    }

    return (
        isLoading ?
            <React.Fragment>{renderLoading()}</React.Fragment>
            :
            <InfiniteScroll next={loadMore} hasMore={hasMore} loader={renderLoading} dataLength={movies.length}>
                <ImageList cols={3}>
                    {renderMoviesCard()}
                </ImageList>
            </InfiniteScroll>
    )
}

export default MovieList
