import React from "react";
import {IconButton, ImageListItem, ImageListItemBar} from "@mui/material";
import { NavigateNext} from "@mui/icons-material";

const MovieCard = ({ title, poster_url, tmdb_url}) => {
    return <ImageListItem sx={{ maxWidth: 345 }}>
        <img
            height={194}
            width={194}
            alt={title}
            src={poster_url}
        />
        <ImageListItemBar
            title={title}
            actionIcon={
                <IconButton
                    onClick={() => window.open(tmdb_url)}
                >
                    <NavigateNext
                        sx={{color: 'white'}}
                    />
                </IconButton>
            }
        />
    </ImageListItem>
}

export default MovieCard
